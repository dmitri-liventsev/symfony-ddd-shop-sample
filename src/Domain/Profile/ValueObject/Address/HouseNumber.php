<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:19
 */

namespace App\Domain\Profile\ValueObject\Address;


use Assert\Assertion;

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
    public static function fromString($houseNumber = ''): self
    {
        if($houseNumber !== '') {
            self::validate($houseNumber);
        }

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

    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan($value, 0); //Its funny but some houses can have house number - 0
    }
}