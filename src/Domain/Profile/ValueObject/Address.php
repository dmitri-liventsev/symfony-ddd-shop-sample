<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\ValueObject;


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

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }


    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }
}