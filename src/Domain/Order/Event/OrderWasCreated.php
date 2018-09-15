<?php

namespace App\Domain\Order\Event;
use App\Domain\Order\Entity\Customer;
use App\Domain\Order\Entity\OrderItem;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderWasCreated implements Serializable {

	/**
	 * @var UuidInterface
	 */
	public $uuid;

	/**
	 * @var Customer
	 */
	public $customer;

	/**
	 * @var OrderItem
	 */
	public $orderItem;

	/**
	 * OrderWasCreated constructor.
	 */
	public function __construct(UuidInterface $uuid, Customer $customer, OrderItem $orderItem) {
		$this->uuid = $uuid;
		$this->customer = $customer;
		$this->orderItem = $orderItem;
	}

	/**
	 * @return OrderWasCreated The object instance
	 */
	public static function deserialize(array $data) {
		return new self(
			Uuid::fromString($data['uuid']),
			new Customer (
				Uuid::fromString($data['customer']['uuid']),
				Uuid::fromString($data['uuid']['user_uuid'])
			),
			new OrderItem(
				Uuid::fromString($data['order_item']['uuid']),
				Uuid::fromString($data['order_item']['product_uuid']),
				$data['orderItem']['amount']
			)
		);
	}

	/**
	 * @return array
	 */
	public function serialize(): array {
		return [
			'uuid' => $this->uuid->toString(),
		    'order_item' => [
		    	'uuid' => $this->orderItem->getUuid()->toString(),
		    	'product_uuid' => $this->orderItem->getProductUuid()->toString(),
		    	'amount' => $this->orderItem->getAmount()->toInteger()
		    ],
		    'customer' => [
		    	'uuid' => $this->customer->getUuid()->toString(),
		        'user_uuid' => $this->customer->getUserUuid()->toString()
		    ]
		];
	}
}