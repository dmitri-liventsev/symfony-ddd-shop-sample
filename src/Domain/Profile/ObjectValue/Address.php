<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\ObjectValue;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class Address {
	/** @var string */
	public $city;

	/** @var string */
	public $street;

	/** @var string */
	public $houseNumber;

	/**
	 * Address constructor.
	 *
	 * @param $city
	 * @param $street
	 * @param $houseNumber
	 */
	public function __construct($city, $street, $houseNumber) {
		$this->city        = $city;
		$this->street      = $street;
		$this->houseNumber = $houseNumber;
	}
}