<?php
namespace App\Infrastructure\User\EventConsumer;

use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Event\UserWasRemoved;
use App\Domain\User\Query\Repository\UserReadModelRepositoryInterface;
use App\Infrastructure\User\Entity\User;
use Broadway\ReadModel\Projector;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class UserEventConsumer  extends Projector {

	/** @var UserReadModelRepositoryInterface */
	private $repository;

	public function __construct(UserReadModelRepositoryInterface $repository)
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
	 * @throws \Assert\AssertionFailedException
	 */
	protected function applyUserWasRemoved(UserWasRemoved $userWasRemoved): void
	{
		$userReadModel = User::fromSerializable($userWasRemoved);

		$this->repository->remove($userReadModel);
	}


}