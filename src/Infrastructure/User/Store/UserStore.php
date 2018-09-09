<?php




namespace App\Infrastructure\User\Store;

use App\Domain\User\Repository\UserStoreInterface;
use App\Domain\User\User;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;
use Ramsey\Uuid\UuidInterface;

class UserStore extends EventSourcingRepository implements UserStoreInterface {
	public function __construct(
		EventStore $eventStore,
		EventBus $eventBus,
		array $eventStreamDecorators = []
	) {
		parent::__construct(
			$eventStore,
			$eventBus,
			User::class,
			new PublicConstructorAggregateFactory(),
			$eventStreamDecorators
		);
	}

	public function store(User $user): void
	{
		$this->save($user);
	}

	public function get(UuidInterface $uuid): User
	{
		/** @var User $user */
		$user = $this->load((string) $uuid);

		return $user;
	}
}
