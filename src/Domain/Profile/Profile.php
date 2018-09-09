<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile;


use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Contact;
use App\Domain\Profile\Event\ProfileWasUpdated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Profile extends EventSourcedAggregateRoot {
	/** @var UuidInterface */
	private $uuid;

	/** @var UuidInterface */
	private $userUuid;

	/** @var Address */
	private $address;

	/** @var Contact */
	private $contact;

	public function change(UuidInterface $userUuid, Address $address, Contact $contact) {
		$this->apply(new ProfileWasUpdated($this->uuid, $userUuid, $address, $contact));
	}

	protected function applyProfileWasUpdated(ProfileWasUpdated $event) {
		$this->uuid = $event->uuid;

		$this->setAddress($event->address);
		$this->setContact($event->contact);
	}

	/**
	 * @return string
	 */
	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface {
		return $this->uuid;
	}

	/**
	 * @return Address
	 */
	public function getAddress(): Address {
		return $this->address;
	}

	/**
	 * @param Address $address
	 */
	public function setAddress(Address $address) {
		$this->address = $address;
	}

	/**
	 * @return Contact
	 */
	public function getContact(): Contact {
		return $this->contact;
	}

	/**
	 * @param Contact $contact
	 */
	public function setContact(Contact $contact) {
		$this->contact = $contact;
	}


}