<?php
use App\Domain\Profile\Profile;
use App\Domain\Profile\Repository\ProfileStoreInterface;
use Broadway\EventSourcing\EventSourcingRepository;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProfileStore extends EventSourcingRepository implements ProfileStoreInterface{

	public function store(Profile $profile) : void {
		$this->save($profile);
	}

	public function get(UuidInterface $uuid): Profile
	{
		/** @var Profile $profile */
		$profile = $this->load((string) $uuid);

		return $profile;
	}
}