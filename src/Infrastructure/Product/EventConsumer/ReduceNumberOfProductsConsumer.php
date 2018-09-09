<?php

namespace App\Infrastructure\Product\EventConsumer;

use App\Domain\Order\Event\OrderWasCreated;
use App\Domain\Product\Repository\ProductModelRepositoryInterface;
use Broadway\ReadModel\Projector;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ReduceNumberOfProductsConsumer extends Projector {

	/** @var ProductModelRepositoryInterface */
	private $repository;

	/**
	 * ReduceNumberOfProductsConsumer constructor.
	 */
	public function __construct(ProductModelRepositoryInterface $repository) {
		$this->repository = $repository;
	}

	protected function applyOrderWasCreated(OrderWasCreated $event) {
		$productUuid = $event['orderItem']['product_uuid'];
		$amount = $event['orderItem']['amount'];

		$product = $this->repository->oneByUuid($productUuid);
		$product->reduceNumberOfProductsOnStock($amount);

		$this->repository->apply();
	}
}