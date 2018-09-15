<?php

namespace App\Domain\Product\Projection;

use App\Domain\Product\ValueObject\ProductOnStock;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
interface ProductViewInterface {
	public function reduceNumberOfProductsOnStock(int $amount): void;
	public function getProductsOnStock() : int;
}