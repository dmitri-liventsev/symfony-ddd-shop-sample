<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Repository;


use App\Domain\Order\Order;
use Ramsey\Uuid\UuidInterface;

interface OrderStoreInterface {

	public function store(Order $order): void;

	public function get(UuidInterface $uuid): Order;
}