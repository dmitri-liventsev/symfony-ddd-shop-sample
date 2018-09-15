<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:13
 */

namespace App\Domain\Product\ValueObject;


use Assert\Assertion;

class Name
{
    private $name;

    /**
     * Price constructor.
     * @param $name
     */
    private function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $name
     * @return Name
     */
    public static function fromString(string $name): self
    {
        self::validate($name);

        return new self($name);
    }

    /**\
     * @return Name
     */
    public static function createBlank() {
        return new self('');
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
    }


    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan(strlen($value), 2);
        Assertion::lessOrEqualThan(strlen($value), 64);
    }
}