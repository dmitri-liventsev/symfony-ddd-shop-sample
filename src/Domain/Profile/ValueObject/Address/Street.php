<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:19
 */

namespace App\Domain\Profile\ValueObject\Address;

use Assert\Assertion;

class Street
{
    private $street;

    /**
     * Price constructor.
     * @param $street
     */
    private function __construct($street)
    {
        $this->street = $street;
    }

    /**
     * @param string $street
     * @return Street
     */
    public static function fromString(string $street = ''): self
    {
        if($street !== '') {
          self::validate($street);
        }

        return new self($street);
    }

    /**
     * @return Street
     */
    public static function createBlank() {
        return new self('');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->street;
    }

    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan(strlen($value), 2);
        Assertion::lessOrEqualThan(strlen($value), 64);
    }
}