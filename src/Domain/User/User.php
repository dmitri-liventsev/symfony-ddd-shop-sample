<?php

namespace App\Domain\User;
use App\Domain\User\Event\UserWasCreated;
use App\Domain\User\Event\UserWasRemoved;
use App\Domain\User\ValueObject\Auth\Credentials;
use App\Domain\User\ValueObject\Auth\HashedPassword;
use App\Domain\User\ValueObject\Email;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class User  extends EventSourcedAggregateRoot{

	/** @var UuidInterface  */
	private $uuid;

	/** @var Email */
	private $email;

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

    protected function applyUserWasCreated(UserWasCreated $event): void
    {
        $this->uuid = $event->uuid;

        $this->setEmail($event->credentials->email);
        $this->setHashedPassword($event->credentials->password);
    }

    protected function applyUserWasRemoved(UserWasRemoved $event): void
    {
        $this->uuid = $event->uuid;
    }

    private function setEmail(Email $email): void
    {
        $this->email = $email;
    }

    private function setHashedPassword(HashedPassword $hashedPassword): void
    {
        $this->hashedPassword = $hashedPassword;
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