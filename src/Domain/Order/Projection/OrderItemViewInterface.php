<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Projection;

use Ramsey\Uuid\UuidInterface;

interface OrderItemViewInterface {
	public function getProductUuid() : UuidInterface;
	public function getAmount() : int;
}