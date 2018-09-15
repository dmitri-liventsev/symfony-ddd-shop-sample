<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:19
 */

namespace App\Domain\Profile\ValueObject\Address;


class City
{
    private $city;

    /**
     * Price constructor.
     * @param $city
     */
    private function __construct($city)
    {
        $this->city = $city;
    }

    /**
     * @param string $city
     * @return City
     */
    public static function fromString(string $city): self
    {
        //Implement validation

        return new self($city);
    }

    /**
     * @return City
     */
    public static function createBlank() {
        return new self('');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->city;
    }
}