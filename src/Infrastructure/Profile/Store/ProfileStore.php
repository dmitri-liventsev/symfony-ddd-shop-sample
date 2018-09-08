<?php

namespace App\Infrastructure\Profile\Store;


use App\Domain\Profile\Profile;
use App\Domain\Profile\Repository\ProfileStoreInterface;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProfileStore extends EventSourcingRepository implements ProfileStoreInterface{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            Profile::class,
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }
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