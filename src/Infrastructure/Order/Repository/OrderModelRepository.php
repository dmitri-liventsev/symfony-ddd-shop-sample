<?php

namespace App\Infrastructure\Order\Repository;

use App\Domain\Order\Projection\OrderViewInterface;
use App\Domain\Order\Repository\OrderModelRepositoryInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderModelRepository extends MysqlRepository implements OrderModelRepositoryInterface {

	public function findAllByUserUuid(UuidInterface $userUuid) {
		$qb = $this->repository
			->createQueryBuilder('order')
			->join('order.customer', 'customer')
			->where('customer.uuid = :uuid')
			->setParameter('uuid', $userUuid->getBytes())
		;

		return $this->execute($qb);
	}

	public function add(OrderViewInterface $orderView): void
	{
		$this->register($orderView);
	}
}