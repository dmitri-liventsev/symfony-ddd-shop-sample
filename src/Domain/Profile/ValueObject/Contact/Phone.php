<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:20
 */

namespace App\Domain\Profile\ValueObject\Contact;

use Assert\Assertion;

class Phone
{
    private $phone;

    /**
     * Price constructor.
     * @param $phone
     */
    private function __construct($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param string $phone
     * @return Phone
     */
    public static function fromString(string $phone = ''): self
    {
        if($phone !== '') {
            self::validate($phone);
        }

        return new self($phone);
    }

    /**
     * @return Phone
     */
    public static function createBlank() : self{
        return new self('');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->phone;
    }

    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan(strlen($value), 5);
        Assertion::lessOrEqualThan(strlen($value), 15);
    }
}