<?php

namespace App\Infrastructure\Order\Entity;

use App\Domain\Order\Projection\OrderItemViewInterface;
use App\Domain\Order\Projection\OrderViewInterface;
use App\Infrastructure\Product\Entity\Product;
use Broadway\Serializer\Serializable;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class Order implements OrderViewInterface, JsonSerializable {
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

		return new self($orderItem, $customer, $data["uuid"]);
	}

	public function serialize() : array {
		return [
			'uuid' => $this->uuid->toString(),
			'order_item' => $this->orderItem->serialize(),
			'customer' => $this->customer->serialize(),
		];
	}

	public function getOrderItem(): OrderItemViewInterface {
		return $this->orderItem;
	}

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
	function jsonSerialize() {
		return $this->serialize();
	}
}