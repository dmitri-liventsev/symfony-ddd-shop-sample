<?php

namespace App\Domain\Profile\Event;
use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Contact;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProfileWasUpdated implements Serializable{
	/** @var UuidInterface  */
	public $uuid;
	/** @var UuidInterface  */
	public $userUuid;
	/** @var Address  */
	public $address;
	/** @var Contact  */
	public $contact;

	/**
	 * ProfileWasUpdated constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param UuidInterface $userUuid
	 * @param Address       $address
	 * @param Contact       $contact
	 */
	public function __construct(UuidInterface $uuid, UuidInterface $userUuid, Address $address, Contact $contact) {
		$this->uuid    = $uuid;
		$this->address = $address;
		$this->contact = $contact;
		$this->userUuid = $userUuid;
	}


	/**
	 * @return mixed The object instance
	 */
	public static function deserialize(array $data) {
		return new self(
			Uuid::fromString($data['uuid']),
			Uuid::fromString($data['user_uuid']),
			new Address($data['Address']['city'], $data['Address']['street'], $data['Address']['house_number']),
			new Contact($data['email'], $data['phone'])
		);
	}

	/**
	 * @return array
	 */
	public function serialize(): array {
		return [
			'uuid' => $this->uuid->toString(),
			'user_uuid' => $this->userUuid->toString(),
		    'Address' => [
		        'city' => $this->address->city,
		        'street' => $this->address->street,
		        'house_number' => $this->address->houseNumber,
		    ],
		    'contact' => [
		    	'email' => $this->contact->email,
		    	'phone' => $this->contact->phone
		    ]
		];
	}
}