<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Projection;

use App\Domain\Product\Projection\ProductViewInterface;

interface OrderItemViewInterface {
	public function getProduct() : ProductViewInterface;
	public function getAmount() : int;
}