<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\Projection;

use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Contact;
use Ramsey\Uuid\UuidInterface;

interface ProfileViewInterface {
	public function getUuid() : UuidInterface;
	public function setAddress(Address $address) : void;
	public function setContact(Contact $contact) : void;
}