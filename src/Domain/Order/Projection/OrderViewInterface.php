<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Projection;


interface OrderViewInterface {
	public function getOrderItem() : OrderItemViewInterface;
}