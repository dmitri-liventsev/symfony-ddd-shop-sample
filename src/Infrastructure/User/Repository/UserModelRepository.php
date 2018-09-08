<?php

namespace App\Infrastructure\User\Repository;

use App\Domain\User\Projection\UserViewInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Domain\User\Repository\CheckUserByEmailInterface;
use App\Domain\User\ValueObject\Email;
use App\Infrastructure\Common\Repository\MysqlRepository;
use App\Infrastructure\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class UserModelRepository extends MysqlRepository implements UserModelRepositoryInterface, CheckUserByEmailInterface{

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->class = User::class;
		parent::__construct($entityManager);
	}

	/**
	 * @throws \App\Domain\Common\Repository\Exception\NotFoundException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function oneByUuid(UuidInterface $uuid): UserViewInterface
	{
		$qb = $this->repository
			->createQueryBuilder('user')
			->where('user.uuid = :uuid')
			->setParameter('uuid', $uuid->getBytes())
		;

		return $this->oneOrException($qb);
	}

	/**
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function existsEmail(Email $email): ?UuidInterface
	{
		$userId = $this->repository
			->createQueryBuilder('user')
			->select('user.uuid')
			->where('user.credentials.email = :email')
			->setParameter('email', (string) $email)
			->getQuery()
			->getOneOrNullResult()
		;

		return $userId['uuid'] ?? null;
	}

	/**
	 * @throws \App\Domain\Common\Repository\Exception\NotFoundException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function oneByEmail(Email $email): UserViewInterface
	{
		$qb = $this->repository
			->createQueryBuilder('user')
			->where('user.credentials.email = :email')
			->setParameter('email', $email->toString())
		;

		return $this->oneOrException($qb);
	}

	public function add(UserViewInterface $userRead): void
	{
		$this->register($userRead);
	}

	public function remove($userRead): void
	{
		$this->remove($userRead);
	}
}