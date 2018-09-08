<?php

namespace App\Domain\Profile\Event;
use App\Domain\Profile\ObjectValue\Address;
use App\Domain\Profile\ObjectValue\Contact;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProfileWasUpdated {
	/** @var UuidInterface  */
	private $uuid;
	/** @var Address  */
	private $address;
	/** @var Contact  */
	private $contact;

	/**
	 * ProfileWasUpdated constructor.
	 *
	 * @param $uuid
	 * @param $address
	 * @param $contact
	 */
	public function __construct(UuidInterface $uuid, Address $address, Contact $contact) {
		$this->uuid    = $uuid;
		$this->address = $address;
		$this->contact = $contact;
	}


}