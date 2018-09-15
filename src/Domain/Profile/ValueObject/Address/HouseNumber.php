<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:19
 */

namespace App\Domain\Profile\ValueObject\Address;


class HouseNumber
{
    private $houseNumber;

    /**
     * Price constructor.
     * @param $houseNumber
     */
    private function __construct($houseNumber)
    {
        $this->houseNumber = $houseNumber;
    }

    /**
     * @param string $houseNumber
     * @return City
     */
    public static function fromString(string $houseNumber): self
    {
        //Implement validation

        return new self($houseNumber);
    }

    /**
     * @return HouseNumber
     */
    public static function createBlank() {
        return new self('');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->houseNumber;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->houseNumber;
    }
}