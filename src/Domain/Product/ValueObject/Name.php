<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:13
 */

namespace App\Domain\Product\ValueObject;


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
     * @param int $name
     * @return Name
     */
    public static function fromString(int $name): self
    {
        //Implement validation

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
}