<?php
namespace App\Infrastructure\User\EventConsumer;

use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Event\UserWasRemoved;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\User\Entity\User;
use Broadway\ReadModel\Projector;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class UserEventConsumer extends Projector {

	/** @var UserModelRepositoryInterface */
	private $repository;

	public function __construct(UserModelRepositoryInterface $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * @throws \Assert\AssertionFailedException
	 */
	protected function applyUserWasCreated(UserWasCreated $userWasCreated): void
	{
		$userReadModel = User::fromSerializable($userWasCreated);

		$this->repository->add($userReadModel);
	}

	/**
	 * @param UserWasRemoved $userWasRemoved
	 */
	protected function applyUserWasRemoved(UserWasRemoved $userWasRemoved): void
	{
		$userReadModel = User::fromSerializable($userWasRemoved);

		$this->repository->remove($userReadModel);
	}
}