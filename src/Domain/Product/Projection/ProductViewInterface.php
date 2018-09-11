<?php

namespace App\Domain\Product\Projection;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
interface ProductViewInterface {
	public function reduceNumberOfProductsOnStock(int $amount): void;
	public function getProductsOnStock() : int;
}