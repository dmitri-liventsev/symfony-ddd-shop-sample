<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\UI\Http\Rest\Controller\Profile;

use App\Application\Command\Profile\ChangeProfile\ChangeProfileCommand;
use App\Domain\Profile\ValueObject\Address;
use App\Domain\Profile\ValueObject\Address\City;
use App\Domain\Profile\ValueObject\Address\HouseNumber;
use App\Domain\Profile\ValueObject\Address\Street;
use App\Domain\Profile\ValueObject\Contact;
use App\Domain\Profile\ValueObject\Contact\Email;
use App\Domain\Profile\ValueObject\Contact\Phone;
use App\UI\Http\Rest\Controller\CommandController;
use Assert\Assertion;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProfileCommandController extends CommandController {

	/**
	 * @Route(
	 *     "/profile/{user_uuid}",
	 *     name="profile",
	 *     methods={"PUT"},
	 *     requirements={
	 *      "address_city": "\w+",
	 *      "address_street": "\w+",
	 *      "address_house_number": "\w+",
	 *
	 *      "contact_email": "\w+",
	 *      "contact_phone": "\w+",
	 * })
	 *
	 * @throws \Assert\AssertionFailedException
	 */
	public function update(Request $request) {
		$userUuidString = $request->get('user_uuid');

		$addressCity = $request->get('address_city');
		$addressStreet = $request->get('address_street');
		$addressHouseNumber = $request->get('address_house_number');

		$contactEmail = $request->get('contact_email');
		$contactPhone = $request->get('contact_phone');


		Assertion::notNull($userUuidString, "Uuid can\'t be null");

		Assertion::notNull($addressCity, "City can\'t be null");
		Assertion::notNull($addressStreet, "Street can\'t be null");
		Assertion::notNull($addressHouseNumber, "House number can\'t be null");

		Assertion::notNull($contactEmail, "Email can\'t be null");
		Assertion::notNull($contactPhone, "Phone number can\'t be null");

		$address = new Address(City::fromString($addressCity), Street::fromString($addressStreet), HouseNumber::fromString($addressHouseNumber));
		$contact = new Contact(Email::fromString($contactEmail), Phone::fromString($contactPhone));

		$commandRequest = new ChangeProfileCommand($userUuidString, $address, $contact);
		$this->exec($commandRequest);

		return JsonResponse::create(null, JsonResponse::HTTP_ACCEPTED);
	}
}