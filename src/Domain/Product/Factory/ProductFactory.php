<?php

namespace App\Domain\Product\Factory;
use App\Domain\Order\Order;
use App\Domain\Product\Product;
use App\Domain\Product\ValueObject\Name;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductOnStock;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProductFactory {
	public function create(UuidInterface $uuid, Name $name, ProductOnStock $productOnStock, $type, Price $price) : Product {
		return Product::create($uuid, $name, $productOnStock, $type, $price);
	}
}