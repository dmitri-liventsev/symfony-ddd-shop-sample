<?php

namespace App\Infrastructure\Order\Entity;

use App\Domain\Order\Projection\OrderItemViewInterface;
use App\Domain\Order\Projection\OrderViewInterface;
use App\Infrastructure\Product\Entity\Product;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class Order implements OrderViewInterface {
	/** @var UuidInterface  */
	private $uuid;

	/** @var  OrderItem */
	private $orderItem;

	/** @var  Customer */
	private $customer;

	/**
	 * Order constructor.
	 *
	 * @param OrderItem $orderItem
	 * @param Customer  $customer
	 * @param string|UuidInterface $uuid
	 */
	public function __construct(OrderItem $orderItem, Customer $customer, $uuid) {
		$this->uuid = is_string($uuid) ? Uuid::fromString($uuid) : $uuid;
		$this->orderItem = $orderItem;
		$this->customer  = $customer;
	}

	public static function fromSerializable(Serializable $event): self
	{
		return self::deserialize($event->serialize());
	}

	/**
	 * @throws \Assert\AssertionFailedException
	 */
	public static function deserialize(array $data): self
	{
		$customer = Customer::deserialize($data["customer"]);
		$orderItem = OrderItem::deserialize($data["order_item"]);

		return new self($orderItem, $customer, $data["order_uuid"]);
	}

	public function getOrderItem(): OrderItemViewInterface {
		return $this->orderItem;
	}
}