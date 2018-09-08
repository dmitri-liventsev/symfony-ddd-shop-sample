<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Order\Store;


use App\Domain\Order\Order;
use App\Domain\Order\Repository\OrderStoreInterface;
use App\Domain\Product\Product;
use App\Domain\User\User;
use Broadway\EventSourcing\EventSourcingRepository;
use Ramsey\Uuid\UuidInterface;

class OrderStore extends EventSourcingRepository implements OrderStoreInterface{

	public function store(Order $order) : void {
		$this->save($order);
	}

	public function get(UuidInterface $uuid): Order
	{
		/** @var Order $order */
		$order = $this->load((string) $uuid);

		return $order;
	}
}