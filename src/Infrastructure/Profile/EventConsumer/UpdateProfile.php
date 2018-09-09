<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Profile\EventConsumer;

use App\Domain\Profile\Event\ProfileWasUpdated;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Contact;
use App\Infrastructure\Profile\Entity\Profile;
use Broadway\ReadModel\Projector;

class UpdateProfile extends Projector {
	/** @var ProfileModelRepositoryInterface  */
	private $repository;

	/**
	 * ReduceNumberOfProductsConsumer constructor.
	 *
	 * @param ProfileModelRepositoryInterface $repository
	 */
	public function __construct(ProfileModelRepositoryInterface $repository) {
		$this->repository = $repository;
	}

	protected function applyProfileWasUpdated(ProfileWasUpdated $event) {
		$profile = $this->repository->oneByUuid($event->uuid);
		$profile->setAddress($event->address);
		$profile->setContact($event->contact);

		$this->repository->apply();
	}
}