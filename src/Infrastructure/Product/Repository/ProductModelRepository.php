<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Product\Projection\ProductViewInterface;
use App\Domain\Product\Repository\ProductModelRepositoryInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;
use App\Infrastructure\Product\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProductModelRepository extends MysqlRepository implements ProductModelRepositoryInterface {

    /**
     * ProductModelRepository constructor.
     * @param EntityManagerInterface $entityManager
     */
	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->class = Product::class;
		parent::__construct($entityManager);
	}

    /**
     * @return mixed
     */
	public function findAllAvailableProducts() {
		$qb = $this->repository
			->createQueryBuilder('product')
			->where('product.productsOnStock > :minValue')
			->setParameter('minValue', 0)
		;

		return $this->execute($qb);
	}

    /**
     * @param ProductViewInterface $productView
     */
	public function add(ProductViewInterface $productView) {
		$this->register($productView);
	}

	/**
	 * @throws \App\Domain\Common\Repository\Exception\NotFoundException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function oneByUuid(UuidInterface $uuid): ProductViewInterface
	{
		$qb = $this->repository
			->createQueryBuilder('product')
			->where('product.uuid = :uuid')
			->setParameter('uuid', $uuid->getBytes())
		;

		return $this->oneOrException($qb);
	}
}