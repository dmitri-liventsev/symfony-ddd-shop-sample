<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\ObjectValue;


class Address {
	private $city;
	private $street;
	private $houseNumber;

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