<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Profile\ChangeProfile;


use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Contact;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ChangeProfileCommand {

	/** @var  UuidInterface */
	public $userUuid;

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
	public function __construct(string $userUuid, Address $address, Contact $contact) {
		$this->userUuid    = Uuid::fromString($userUuid);
		$this->address = $address;
		$this->contact = $contact;
	}
}