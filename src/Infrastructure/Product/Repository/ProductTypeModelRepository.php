<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:37
 */

namespace App\Infrastructure\Product\Repository;

use App\Domain\Order\Repository\OrderItemModelRepositoryInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;

class ProductTypeModelRepository extends MysqlRepository implements OrderItemModelRepositoryInterface
{

}