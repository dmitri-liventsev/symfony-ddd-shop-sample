<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Product\EventConsumer;


use App\Domain\Product\Event\ProductWasCreated;
use App\Domain\Product\Repository\ProductModelRepositoryInterface;
use App\Infrastructure\Product\Entity\Product;
use Broadway\ReadModel\Projector;

class CreateProductConsumer extends Projector  {
	/** @var ProductModelRepositoryInterface */
	private $repository;

	public function __construct(ProductModelRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws \Assert\AssertionFailedException
	 */
	protected function applyProductWasCreated(ProductWasCreated $productWasCreated): void
	{
		$userReadModel = Product::fromSerializable($productWasCreated);

		$this->repository->add($userReadModel);
	}
}