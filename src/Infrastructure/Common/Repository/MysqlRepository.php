<?php

namespace App\Infrastructure\Common\Repository;

use App\Domain\Common\Repository\Exception\NotFoundException;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class MysqlRepository
{
    public function register($model): void
    {
        $this->entityManager->persist($model);
        $this->apply();
    }

    public function remove($model): void
    {
        $this->entityManager->remove($model);
        $this->apply();
    }

    public function apply(): void
    {
        $this->entityManager->flush();
    }

    protected function execute(QueryBuilder $queryBuilder) {
    	return $queryBuilder->getQuery()->execute();
    }

    /**
     * @throws NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function oneOrException(QueryBuilder $queryBuilder)
    {
        $model = $queryBuilder
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (null === $model) {
            throw new NotFoundException();
        }

        return $model;
    }

    private function setRepository(string $model): void
    {
        /** @var EntityRepository $objectRepository */
        $objectRepository = $this->entityManager->getRepository($model);
        $this->repository = $objectRepository;
    }

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->setRepository($this->class);
    }

    /** @var string */
    protected $class;

    /** @var EntityRepository */
    protected $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
}
