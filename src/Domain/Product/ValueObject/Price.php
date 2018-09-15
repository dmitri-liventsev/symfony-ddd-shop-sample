<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:14
 */

namespace App\Domain\Product\ValueObject;


use Assert\Assertion;

class Price
{
    private $price;

    /**
     * Price constructor.
     * @param $price
     */
    private function __construct($price)
    {
        $this->price = $price;
    }

    /**
     * @param int $price
     * @return Price
     */
    public static function fromString(string $price): self
    {
        $price = (int) $price;

        self::validate($price);

        return new self($price);
    }

    /**
     * @param int $price
     * @return Price
     */
    public static function fromInt(int $price): self
    {
        self::validate($price);

        return new self($price);
    }

    /**
     * @return Price
     */
    public static function createBlank() {
        return new self(0);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function toInteger(): int
    {
        return (int) $this->price;
    }

    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan($value, 0);
    }
}