<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product\Repository;


use App\Domain\Order\Projection\OrderViewInterface;
use App\Domain\Product\Projection\ProductViewInterface;
use Ramsey\Uuid\UuidInterface;

interface ProductModelRepositoryInterface {
	public function findAllAvailableProducts();
	public function add(ProductViewInterface $productView);
	public function oneByUuid(UuidInterface $uuid) : ProductViewInterface;
	public function apply(): void;
}