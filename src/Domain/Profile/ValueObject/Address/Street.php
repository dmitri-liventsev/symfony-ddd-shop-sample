<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:19
 */

namespace App\Domain\Profile\ValueObject\Address;


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
    public static function fromString(string $street): self
    {
        //Implement validation

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
}