<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\EventSubscriber;

use App\Domain\Common\Repository\Exception\NotFoundException;
use App\Domain\User\Exception\ForbiddenException;
use App\Domain\User\Exception\InvalidCredentialsException;
use Broadway\Repository\AggregateNotFoundException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
    	var_dump($event->getException()->getMessage());
    	var_dump($event->getException()->getTraceAsString()); exit;
        $exception = $event->getException();

        $response = new JsonResponse();
        $response->headers->set('Content-Type', 'application/vnd.api+json');
        $response->setStatusCode($this->getStatusCode($exception));
        $response->setData($this->getErrorMessage($exception, $response));

        $event->setResponse($response);
    }

    private function getStatusCode(\Exception $exception): int
    {
        return $this->determineStatusCode($exception);
    }

    private function getErrorMessage(\Exception $exception, Response $response): array
    {
        $error = [
            'errors'=> [
                'title'     => str_replace('\\', '.', \get_class($exception)),
                'detail'    => $this->getExceptionMessage($exception),
                'code'      => $exception->getCode(),
                'status'    => $response->getStatusCode(),
            ],
        ];

        if ('dev' === $this->environment) {
            $error = array_merge(
                $error,
                [
                    'meta' => [
                        'file'          => $exception->getFile(),
                        'line'          => $exception->getLine(),
                        'message'       => $exception->getMessage(),
                        'trace'         => $exception->getTrace(),
                        'traceString'   => $exception->getTraceAsString(),
                    ],
                ]
            );
        }

        return $error;
    }

    private function getExceptionMessage(\Exception $exception): string
    {
        return $exception->getMessage();
    }

    private function determineStatusCode(\Exception $exception): int
    {
        // Default status code is always 500
        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        switch (true) {
            case $exception instanceof HttpExceptionInterface:
                $statusCode = $exception->getStatusCode();

                break;
            case $exception instanceof InvalidCredentialsException:
                $statusCode = Response::HTTP_UNAUTHORIZED;

                break;
            case $exception instanceof ForbiddenException:
                $statusCode = Response::HTTP_FORBIDDEN;

                break;
            case $exception instanceof AggregateNotFoundException || $exception instanceof NotFoundException:
                $statusCode = Response::HTTP_NOT_FOUND;

                break;
            case $exception instanceof \InvalidArgumentException:
                $statusCode = Response::HTTP_BAD_REQUEST;

                break;
        }

        return $statusCode;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function __construct()
    {
        $this->environment = \getenv('APP_ENV');
    }

    /**
     * @var string
     */
    private $environment;
}
