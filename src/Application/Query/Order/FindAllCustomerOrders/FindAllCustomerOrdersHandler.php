<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Query\Order\FindAllCustomerOrders;

use App\Application\Query\Collection;
use App\Application\Query\QueryHandlerInterface;
use App\Domain\Order\Repository\OrderModelRepositoryInterface;

class FindAllCustomerOrdersHandler implements QueryHandlerInterface{
	const PER_PAGE = 25;

	/** @var OrderModelRepositoryInterface  */
	private $repository;

	public function __construct(OrderModelRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	public function __invoke(FindAllCustomerOrdersQuery $query): Collection
	{
		$items = $this->repository->findAllByUserUuid($query->userUuid);

		return new Collection($query->page, self::PER_PAGE,  $items);
	}
}