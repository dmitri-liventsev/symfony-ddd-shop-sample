<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\ValueObject;


use App\Domain\Profile\ValueObject\Address\City;
use App\Domain\Profile\ValueObject\Address\HouseNumber;
use App\Domain\Profile\ValueObject\Address\Street;

class Address {
	/** @var City  */
	public $city;

	/** @var Street  */
	public $street;

	/** @var HouseNumber  */
	public $houseNumber;

	/**
	 * Address constructor.
	 *
	 * @param $city
	 * @param $street
	 * @param $houseNumber
	 */
	public function __construct(City $city, Street $street, HouseNumber $houseNumber) {
		$this->city        = $city;
		$this->street      = $street;
		$this->houseNumber = $houseNumber;
	}

    /**
     * @return Address
     */
	public static function createBlank() {
        return new self(City::createBlank(), Street::createBlank(), HouseNumber::createBlank());
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
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     */
    public function setHouseNumber(string $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }
}