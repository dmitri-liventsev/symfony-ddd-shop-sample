<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 16.09.2018
 * Time: 0:34
 */

namespace App\Domain\Order\ValueObject\OrderItem;


use Assert\Assertion;

class Amount
{
    private $amount;

    /**
     * Price constructor.
     * @param $amount
     */
    private function __construct($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @param string $amount
     * @return Amount
     */
    public static function fromString(string $amount): self
    {
        $amount = (int) $amount;

        self::validate($amount);

        return new self($amount);
    }

    /**
     * @param int $price
     * @return Amount
     */
    public static function fromInt(int $price): self
    {
        self::validate($price);

        return new self($price);
    }

    /**
     * @return Amount
     */
    public static function createBlank() {
        return new self(0);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function toInteger(): int
    {
        return (int) $this->amount;
    }

    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan($value, 0);
    }
}