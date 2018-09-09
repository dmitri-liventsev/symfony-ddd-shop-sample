<?php
namespace App\Domain\Profile\Factory;

use App\Domain\Profile\Profile;
use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Contact;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class ProfileFactory {
	public function create(UuidInterface $uuid, UuidInterface $userUuid, Address $address, Contact $contact) {
		return Profile::create($uuid, $userUuid, $address, $contact);
	}
}