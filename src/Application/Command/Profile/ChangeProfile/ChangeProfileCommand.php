<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Profile\ChangeProfile;


use App\Domain\Profile\ObjectValue\Address;
use App\Domain\Profile\ObjectValue\Contact;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ChangeProfileCommand {
	/** @var  UuidInterface */
	public $uuid;

	/** @var  Address */
	public $address;

	/** @var  Contact */
	public $contact;

	/**
	 * ChangeProfileCommand constructor.
	 *
	 * @param string $uuid
	 * @param Address       $address
	 * @param Contact       $contact
	 */
	public function __construct(string $uuid, Address $address, Contact $contact) {
		$this->uuid    = Uuid::fromString($uuid);
		$this->address = $address;
		$this->contact = $contact;
	}
}