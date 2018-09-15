<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\Event;


use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Address\City;
use App\Domain\Profile\ValueObject\Address\HouseNumber;
use App\Domain\Profile\ValueObject\Address\Street;
use App\Domain\Profile\ValueObject\Contact;
use App\Domain\Profile\ValueObject\Contact\Email;
use App\Domain\Profile\ValueObject\Contact\Phone;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProfileWasCreated implements Serializable {
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
     * @throws \Assert\AssertionFailedException
     */
	public static function deserialize(array $data) {
		return new self(
			Uuid::fromString($data['uuid']),
			Uuid::fromString($data['user_uuid']),
			new Address(
			    City::fromString($data['Address']['city']),
                Street::fromString($data['Address']['street']),
                HouseNumber::fromString($data['Address']['house_number'])
            ),
			new Contact(
			    Email::fromString($data['contact']['email']),
                Phone::fromString($data['contact']['phone'])
            )
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
				'city' => $this->address->city->toString(),
				'street' => $this->address->street->toString(),
				'house_number' => $this->address->houseNumber->toString(),
			],
			'contact' => [
				'email' => $this->contact->email->toString(),
				'phone' => $this->contact->phone->toString()
			]
		];
	}
}