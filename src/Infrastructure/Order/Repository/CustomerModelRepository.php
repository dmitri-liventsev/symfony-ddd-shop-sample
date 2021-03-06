<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 23:41
 */

namespace App\Infrastructure\Order\Repository;

use App\Domain\Order\Repository\CustomerModelRepositoryInterface;
use App\Infrastructure\Common\Repository\MysqlRepository;

class CustomerModelRepository extends MysqlRepository implements CustomerModelRepositoryInterface
{

}