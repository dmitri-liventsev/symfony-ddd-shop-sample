<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product\Entity;

use Ramsey\Uuid\UuidInterface;

interface ProductViewInterface {
	public function getUuid() : UuidInterface;
	public function reduceNumberOfProductsOnStock(int $amount) : void;
}