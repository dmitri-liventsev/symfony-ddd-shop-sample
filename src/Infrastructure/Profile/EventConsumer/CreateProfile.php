<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Profile\EventConsumer;


use App\Domain\Profile\Event\ProfileWasCreated;
use App\Domain\Profile\Factory\ProfileFactory;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\Profile\Repository\ProfileStoreInterface;
use App\Infrastructure\Profile\Entity\Profile;
use Broadway\ReadModel\Projector;

class CreateProfile extends Projector {

	/** @var ProfileModelRepositoryInterface */
	private $repository;

	/** @var ProfileFactory  */
	private $profileFactory;

	/** @var ProfileStoreInterface  */
	private $profileStore;

	/**
	 * ReduceNumberOfProductsConsumer constructor.
	 *
	 * @param ProfileModelRepositoryInterface $repository
	 * @param ProfileFactory                  $profileFactory
	 * @param ProfileStoreInterface           $profileStore
	 */
	public function __construct(ProfileModelRepositoryInterface $repository, ProfileFactory $profileFactory, ProfileStoreInterface $profileStore) {
		$this->repository = $repository;
		$this->profileFactory = $profileFactory;
		$this->profileStore = $profileStore;
	}

	protected function applyProfileWasCreated(ProfileWasCreated $event) {
		$userReadModel = Profile::fromSerializable($event);

		$this->repository->add($userReadModel);
	}
}