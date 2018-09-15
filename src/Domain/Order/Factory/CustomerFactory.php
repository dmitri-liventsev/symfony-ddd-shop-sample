<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 16.09.2018
 * Time: 0:39
 */

namespace App\Domain\Order\Factory;


use App\Domain\Order\Entity\Customer;
use Ramsey\Uuid\UuidInterface;

class CustomerFactory
{
    /**
     * @param UuidInterface $uuid
     * @param UuidInterface $userUuid
     * @return Customer
     */
    public static function create(UuidInterface $uuid, UuidInterface $userUuid) {
        return new Customer($uuid, $userUuid);
    }
}