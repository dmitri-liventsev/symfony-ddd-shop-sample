<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 14.09.2018
 * Time: 23:36
 */

namespace App\Infrastructure\Order\Repository;

use App\Domain\Order\Repository\CustomerModelRepositoryInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;

class OrderItemModelRepository extends MysqlRepository implements CustomerModelRepositoryInterface
{

}