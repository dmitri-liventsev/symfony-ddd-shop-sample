<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 16.09.2018
 * Time: 0:37
 */

namespace App\Domain\Order\Factory;

use App\Domain\Order\Entity\OrderItem;
use App\Domain\Order\ValueObject\OrderItem\Amount;
use Ramsey\Uuid\UuidInterface;

class OrderItemFactory
{
    public static function create(UuidInterface $uuid, UuidInterface $productUuid, Amount $amount) {
        return new OrderItem($uuid, $productUuid, $amount);
    }
}