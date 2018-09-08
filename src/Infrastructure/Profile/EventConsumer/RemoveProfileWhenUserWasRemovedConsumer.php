<?php

namespace App\Infrastructure\Profile\EventConsumer;

use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Event\UserWasRemoved;
use Broadway\ReadModel\Projector;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class RemoveProfileWhenUserWasRemovedConsumer extends Projector {


	/** @var ProfileModelRepositoryInterface */
	private $repository;

	/**
	 * ReduceNumberOfProductsConsumer constructor.
	 *
	 * @param ProfileModelRepositoryInterface $repository
	 */
	public function __construct(ProfileModelRepositoryInterface $repository) {
		$this->repository = $repository;
	}

	protected function applyUserWasRemoved(UserWasRemoved $event) {
		$profileUuid = $event->uuid;

		$profile = $this->repository->oneByUserUuid($profileUuid);

		$this->repository->remove($profile);
	}
}