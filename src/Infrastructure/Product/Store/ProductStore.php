<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Product\Store;

use App\Domain\Product\Product;
use App\Domain\Product\Repository\ProductStoreInterface;
use Broadway\EventSourcing\EventSourcingRepository;
use Ramsey\Uuid\UuidInterface;

class ProductStore extends EventSourcingRepository implements ProductStoreInterface{

	public function store(Product $product) : void {
		$this->save($product);
	}

	public function get(UuidInterface $uuid): Product
	{
		/** @var Product $product */
		$product = $this->load((string) $uuid);

		return $product;
	}
}