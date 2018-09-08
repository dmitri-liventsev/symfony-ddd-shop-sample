<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Profile\EventConsumer;

use App\Domain\Profile\ObjectValue\Address;
use App\Domain\Profile\ObjectValue\Contact;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Event\UserWasCreated;
use App\Infrastructure\Profile\Entity\Profile;
use Broadway\ReadModel\Projector;
use Ramsey\Uuid\Uuid;

class CreateProfileForNewUsers extends Projector {

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

	protected function applyUserWasCreated(UserWasCreated $event) {
		$profile = new Profile(Uuid::uuid4(), $event->uuid, new Address("", "", ""), new Contact("", ""));
		$this->repository->add($profile);
	}
}