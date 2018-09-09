<?php
namespace App\Infrastructure\Profile\Repository;

use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\Profile\Projection\ProfileViewInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;
use App\Infrastructure\Profile\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProfileModelRepository extends MysqlRepository implements ProfileModelRepositoryInterface {

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->class = Profile::class;
		parent::__construct($entityManager);
	}

	/**
	 * @param UuidInterface $userUuid
	 *
	 * @return ProfileViewInterface
	 * @internal param \UuidInterface $uuid
	 */
    public function oneByUserUuid(UuidInterface $userUuid): ProfileViewInterface {
		$qb = $this->repository
			->createQueryBuilder('profile')
			->where('profile.userUuid = :uuid')
			->setParameter('uuid', $userUuid->getBytes())
		;

		return $this->oneOrException($qb);
	}

	public function add(ProfileViewInterface $profile) {
		$this->register($profile);
	}

	/**
	 * @throws \App\Domain\Common\Repository\Exception\NotFoundException
	 * @throws \Doctrine\ORM\NonUniqueResultException
	 */
	public function oneByUuid(UuidInterface $uuid): ProfileViewInterface
	{
		$qb = $this->repository
			->createQueryBuilder('profile')
			->where('profile.uuid = :uuid')
			->setParameter('uuid', $uuid->getBytes())
		;

		return $this->oneOrException($qb);
	}
}