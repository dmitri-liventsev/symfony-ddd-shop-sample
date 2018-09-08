<?php

namespace App\Infrastructure\Profile\Entity;

use App\Domain\Profile\ObjectValue\Address;
use App\Domain\Profile\ObjectValue\Contact;
use App\Domain\Profile\Projection\ProfileViewInterface;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class Profile implements ProfileViewInterface{
	/** @var UuidInterface */
	private $uuid;

	/** @var UuidInterface */
	private $userUuid;

	/** @var  Address */
	private $address;

	/** @var  Contact */
	private $contact;

	/**
	 * Profile constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param UuidInterface $userUuid
	 * @param Address       $address
	 * @param Contact       $contact
	 */
	public function __construct(UuidInterface $uuid, UuidInterface $userUuid, Address $address, Contact $contact) {
		$this->uuid    = $uuid;
		$this->userUuid    = $userUuid;
		$this->address = $address;
		$this->contact = $contact;
	}


	public static function fromSerializable(Serializable $event): self
	{
		return self::deserialize($event->serialize());
	}

	/**
	 * @throws \Assert\AssertionFailedException
	 */
	public static function deserialize(array $data): self
	{
		$uuid = Uuid::fromString($data['uuid']);
		$userUuid = Uuid::fromString($data['user_uuid']);
		
		//$city, $street, $houseNumber
		$address = new Address(
			$data['address']['city'],
			$data['address']['street'],
			$data['address']['house_number']
		);

		//$email, $phone
		$contact = new Contact(
			$data['contact']['email'],
			$data['contact']['phone']
		);

		$instance = new self($uuid, $userUuid, $address, $contact);

		return $instance;
	}

	public function serialize(): array
	{
		return [
			'uuid'        => $this->getId(),
			'address' => [
				'city' => (string) $this->address->city,
				'street' => (string) $this->address->street,
				'house_number' => (string) $this->address->houseNumber,
			],
		    'contact' => [
		    	'email' => (string) $this->contact->email,
		    	'phone' => (string) $this->contact->phone,
		    ]
		];
	}

	public function getId(): string
	{
		return (string) $this->uuid;
	}
}