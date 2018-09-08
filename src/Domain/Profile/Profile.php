<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile;


use App\Domain\Profile\ObjectValue\Address;
use App\Domain\Profile\ObjectValue\Contact;
use App\Domain\Profile\Event\ProfileWasUpdated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Profile extends EventSourcedAggregateRoot {
	/** @var UuidInterface */
	private $uuid;

	public function change(Address $address, Contact $contact) {
		$this->apply(new ProfileWasUpdated($this->uuid, $address, $contact));
	}

	/**
	 * @return string
	 */
	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}
}