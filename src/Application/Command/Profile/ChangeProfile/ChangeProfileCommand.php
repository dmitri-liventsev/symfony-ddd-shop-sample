<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Profile;


use App\Domain\Profile\ObjectValue\Address;
use App\Domain\Profile\ObjectValue\Contact;
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
	 * @param UuidInterface $uuid
	 * @param Address       $address
	 * @param Contact       $contact
	 */
	public function __construct(UuidInterface $uuid, Address $address, Contact $contact) {
		$this->uuid    = $uuid;
		$this->address = $address;
		$this->contact = $contact;
	}
}