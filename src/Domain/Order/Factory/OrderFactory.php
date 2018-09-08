<?php

namespace App\Domain\Order\Factory;

use App\Domain\Order\Entity\Customer;
use App\Domain\Order\Entity\OrderItem;
use App\Domain\Order\Order;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderFactory {
	public function purchaseProduct(UuidInterface $uuid, UuidInterface $userUuid, UuidInterface $productUuid, int $amount) : Order {

		$customer = new Customer(Uuid::uuid4(), $userUuid);
		$orderItem = new OrderItem(Uuid::uuid4(), $productUuid, $amount);

		return Order::create($uuid, $customer, $orderItem);
	}
}