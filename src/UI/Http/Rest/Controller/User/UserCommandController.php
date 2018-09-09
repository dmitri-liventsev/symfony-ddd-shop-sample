<?php

declare(strict_types=1);

namespace App\UI\Http\Rest\Controller\User;

use App\Application\Command\User\Remove\RemoveCommand;
use App\Application\Command\User\SignUp\SignUpCommand;
use App\UI\Http\Rest\Controller\CommandController;
use Assert\Assertion;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class UserCommandController extends CommandController
{
    /**
     * @Route(
     *     "/users",
     *     name="user_create",
     *     methods={"POST"},
     *     requirements={
     *      "email": "\w+",
     *      "password": "\w+"
     * })
     *
     * @throws \Assert\AssertionFailedException
     */
    public function signUp(Request $request): JsonResponse
    {
        $uuid = $request->get('uuid', Uuid::uuid4()->toString());
        $email = $request->get('email');
        $plainPassword = $request->get('password');

        Assertion::notNull($uuid, "Uuid can\'t be null");
        Assertion::notNull($email, "Email can\'t be null");
        Assertion::notNull($plainPassword, "Password can\'t be null");

        $commandRequest = new SignUpCommand($uuid, $email, $plainPassword);

        $this->exec($commandRequest);

        return JsonResponse::create(null, JsonResponse::HTTP_CREATED);
    }

	/**
	 * @Route(
	 *     "/user/{uuid}",
	 *     name="user_remove",
	 *     methods={"DELETE"}
	 * )
	 *
	 * @throws \Assert\AssertionFailedException
	 */
    public function remove(Request $request): JsonResponse
    {
	    $uuid = $request->get('uuid');
	    Assertion::notNull($uuid, "Uuid can\'t be null");

	    $commandRequest = new RemoveCommand($uuid);

	    $this->exec($commandRequest);

	    return JsonResponse::create(null, JsonResponse::HTTP_OK);
    }
}
