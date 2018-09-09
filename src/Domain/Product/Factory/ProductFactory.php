<?php

namespace App\Domain\Product\Factory;
use App\Domain\Order\Order;
use App\Domain\Product\Product;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProductFactory {
	public function create(UuidInterface $uuid, $name, $type, $price) : Product {
		return Product::create($uuid, $name, $type, (int) $price);
	}
}