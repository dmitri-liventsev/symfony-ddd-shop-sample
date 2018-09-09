<?php

namespace App\Infrastructure\Common\Log;

use Broadway\Domain\DomainMessage;
use Broadway\EventHandling\EventListener;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

final class LogPublisher implements EventPublisher, EventSubscriberInterface, EventListener
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;

	/** @var DomainMessage[] */
	private $events = [];

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function publish(): void
	{
		if (empty($this->events)) {
			return;
		}

		foreach ($this->events as $event) {
			$this->logger->debug($event->getType() . " | " . serialize($event));
		}
	}

	public function handle(DomainMessage $message): void
	{
		$this->events[] = $message;
	}

	public static function getSubscribedEvents()
	{
		return [
			KernelEvents::TERMINATE  => 'publish',
			ConsoleEvents::TERMINATE => 'publish',
		];
	}
}
