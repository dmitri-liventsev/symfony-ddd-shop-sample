<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Order\EventConsumer;


use App\Domain\Order\Event\OrderWasCreated;
use App\Domain\Order\Repository\OrderModelRepositoryInterface;
use App\Infrastructure\Order\Entity\Order;
use Broadway\ReadModel\Projector;

class OrderWasCreatedConsumer extends Projector {
	/** @var OrderModelRepositoryInterface */
	private $repository;

	/**
	 * OrderWasCreatedConsumer constructor.
	 *
	 * @param OrderModelRepositoryInterface $repository
	 */
	public function __construct(OrderModelRepositoryInterface $repository) {
		$this->repository = $repository;
	}

    /**
     * @param OrderWasCreated $event
     * @throws \Assert\AssertionFailedException
     */
    protected function applyOrderWasCreated(OrderWasCreated $event) {
		$orderEntity = Order::fromSerializable($event);

		$this->repository->add($orderEntity);
	}
}