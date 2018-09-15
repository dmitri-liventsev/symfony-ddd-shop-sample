<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Profile\EventConsumer;

use App\Domain\Profile\Factory\ProfileFactory;
use App\Domain\Profile\Repository\ProfileStoreInterface;
use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Address\City;
use App\Domain\Profile\ValueObject\Address\HouseNumber;
use App\Domain\Profile\ValueObject\Address\Street;
use App\Domain\Profile\ValueObject\Contact;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\Profile\ValueObject\Contact\Phone;
use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\ValueObject\Email;
use App\Infrastructure\Profile\Entity\Profile;
use Broadway\ReadModel\Projector;
use Ramsey\Uuid\Uuid;

class CreateProfileForNewUsers extends Projector {

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

    /**
     * @param UserWasCreated $event
     * @throws \Exception
     */
    protected function applyUserWasCreated(UserWasCreated $event) {
		$uuid = Uuid::uuid4();
		$address = Address::createBlank();
		$contact = Contact::createBlank();

		$profileAggregator = $this->profileFactory->create($uuid, $event->uuid, $address, $contact);
		$this->profileStore->store($profileAggregator);
	}
}