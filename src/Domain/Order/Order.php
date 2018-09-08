<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order;

use App\Domain\Order\Entity\Customer;
use App\Domain\Order\Entity\OrderItem;
use App\Domain\Order\Event\OrderWasCreated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Order extends EventSourcedAggregateRoot {

	/** @var UuidInterface */
	private $uuid;

	/** @var  Customer */
	private $customer;

	/** @var  OrderItem */
	private $orderItem;

	/** @var string  */
	private $status = "draft";

	public static function create(UuidInterface $uuid, Customer $customer, OrderItem $orderItem) : self {
		$order = new self();
		$order->apply(new OrderWasCreated($uuid, $customer, $orderItem));
	}

	/**
	 * @return string
	 */
	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}

	protected function applyUserWasCreated(OrderWasCreated $event): void
	{
		$this->uuid = $event->uuid;

		$this->setCustomer($event->customer);
		$this->setOrderItem($event->orderItem);
	}

	private function setCustomer($customer) {
		$this->customer = $customer;
	}

	private function setOrderItem($orderItem) {
		$this->orderItem = $orderItem;
	}
}