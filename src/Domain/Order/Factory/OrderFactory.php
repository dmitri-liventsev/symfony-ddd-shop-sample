<?php

namespace App\Domain\Order\Factory;

use App\Domain\Order\Entity\Customer;
use App\Domain\Order\Entity\OrderItem;
use App\Domain\Order\Order;
use App\Domain\Order\ValueObject\OrderItem\Amount;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderFactory {
    /**
     * @param UuidInterface $uuid
     * @param UuidInterface $userUuid
     * @param UuidInterface $productUuid
     * @param Amount $amount
     * @return Order
     * @throws \Exception
     */
    public function purchaseProduct(UuidInterface $uuid, UuidInterface $userUuid, UuidInterface $productUuid, Amount $amount) : Order {

		$customer = CustomerFactory::create(Uuid::uuid4(), $userUuid);
		$orderItem = OrderItemFactory::create(Uuid::uuid4(), $productUuid, $amount);

		return Order::create($uuid, $customer, $orderItem);
	}
}