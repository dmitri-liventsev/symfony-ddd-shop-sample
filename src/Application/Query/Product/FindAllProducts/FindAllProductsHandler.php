<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Query\Product\PurchaseProduct;

use App\Application\Query\Collection;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Order\Repository\OrderModelRepositoryInterface;
use App\Domain\Product\Repository\ProductModelRepositoryInterface;

class FindAllProductsHandler implements QueryHandlerInterface{
	const PER_PAGE = 25;

	/** @var ProductModelRepositoryInterface  */
	private $repository;

	public function __construct(ProductModelRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(FindAllProductsQuery $query): Collection
	{
		$items = $this->repository->findAllAvailableProducts();

		return new Collection($query->page, self::PER_PAGE,  $items);
	}
}