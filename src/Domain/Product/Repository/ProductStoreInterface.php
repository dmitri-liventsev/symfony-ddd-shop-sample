<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product\Repository;

use App\Domain\Product\Product;
use Ramsey\Uuid\UuidInterface;

interface ProductStoreInterface {
	public function store(Product $order): void;

	public function get(UuidInterface $uuid): Product;
}