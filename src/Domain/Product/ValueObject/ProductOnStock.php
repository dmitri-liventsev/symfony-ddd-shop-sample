<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 15.09.2018
 * Time: 21:50
 */

namespace App\Domain\Product\ValueObject;


use Assert\Assertion;

class ProductOnStock
{
    private $productOnStock;

    /**
     * ProductOnStock constructor.
     * @param $productOnStock
     */
    private function __construct(int $productOnStock)
    {
        $this->productOnStock = $productOnStock;
    }

    /**
     * @param int $productOnStock
     * @return ProductOnStock
     */
    public static function fromString(string $productOnStock): self
    {
        $productOnStock = (int) $productOnStock;
        self::validate($productOnStock);

        return new self($productOnStock);
    }

    /**
     * @param int $productOnStock
     * @return ProductOnStock
     */
    public static function fromInt(int $productOnStock): self
    {
        self::validate($productOnStock);

        return new self($productOnStock);
    }

    /**
     * @return ProductOnStock
     */
    public static function createBlank() {
        return new self(0);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->productOnStock;
    }

    /**
     * @return string
     */
    public function toInteger(): int
    {
        return (int) $this->productOnStock;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->productOnStock;
    }

    /**
     * @param $value
     */
    private static function validate($value) {
        Assertion::greaterOrEqualThan($value, 0);
    }
}