<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 11.09.2018
 * Time: 18:16
 */

namespace App\Tests\Helper\EntityBuilder;


use App\Domain\Product\ValueObject\Name;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductOnStock;
use App\Infrastructure\Product\Entity\Product;
use App\Tests\Helper\Randomize;
use Ramsey\Uuid\Uuid;

class ProductBuilder
{
    const DEFAULT_PRODUCT_TYPE = "Book";

    /**
     * @return Product
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public static function random()
    {
        return Product::deserialize([
            'uuid' => Uuid::uuid4(),
            'name' => Randomize::string(),
            'product_on_stock' => Randomize::number(10),
            'type' => self::DEFAULT_PRODUCT_TYPE,
            'price' => Randomize::number(100, 1000),
        ]);
    }
}