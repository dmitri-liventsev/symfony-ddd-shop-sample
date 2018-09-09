<?php

namespace App\Domain\Product\Factory;
use App\Domain\Order\Order;
use App\Domain\Product\Product;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProductFactory {
	public function create(UuidInterface $uuid, $name, $productOnStock, $type, $price) : Product {
		return Product::create($uuid, $name, $productOnStock, $type, (int) $price);
	}
}