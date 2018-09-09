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
	/** @var Address  */
	public $address;
	/** @var Contact  */
	public $contact;

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


	/**
	 * @return mixed The object instance
	 */
	public static function deserialize(array $data) {
		return new self(
			Uuid::fromString($data['uuid']),
			new Address($data['address']['city'], $data['address']['street'], $data['address']['house_number']),
			new Contact($data['email'], $data['phone'])
		);
	}

	/**
	 * @return array
	 */
	public function serialize(): array {
		return [
			'uuid' => $this->uuid->toString(),
		    'address' => [
		        'city' => $this->address->city,
		        'street' => $this->address->street,
		        'house_number' => $this->address->house_number,
		    ],
		    'contact' => [
		    	'email' => $this->contact->email,
		    	'phone' => $this->contact->phone
		    ]
		];
	}
}