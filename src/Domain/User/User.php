<?php

namespace App\Domain\User;
use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Event\UserWasRemoved;
use App\Domain\User\ValueObject\Auth\Credentials;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class User  extends EventSourcedAggregateRoot{

	/** @var UuidInterface  */
	private $uuid;

	public static function create(UuidInterface $uuid, Credentials $credentials): self
	{
		$user = new self();

		$user->apply(new UserWasCreated($uuid, $credentials));

		return $user;
	}

	public function remove(): self
	{
		$this->apply(new UserWasRemoved($this->uuid));

		return $this;
	}

	public function uuid(): string
	{
		return $this->uuid->toString();
	}

	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}
}