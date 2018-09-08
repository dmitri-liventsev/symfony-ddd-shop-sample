<?php
namespace App\Infrastructure\Profile\Repository;

use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\Profile\Projection\ProfileViewInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;
use App\Infrastructure\Profile\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;

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
     * @param \Ramsey\Uuid\UuidInterface $uuid
     * @return ProfileViewInterface
     * @throws \App\Domain\Common\Repository\Exception\NotFoundException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function oneByUserUuid(\Ramsey\Uuid\UuidInterface $uuid): ProfileViewInterface {
		$qb = $this->repository
			->createQueryBuilder('user')
			->where('user.uuid = :uuid')
			->setParameter('uuid', $uuid->getBytes())
		;

		return $this->oneOrException($qb);
	}

	public function add(ProfileViewInterface $profile) {
		$this->register($profile);
	}
}