<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Repository;


use App\Domain\Order\Projection\OrderViewInterface;
use Ramsey\Uuid\UuidInterface;

interface OrderModelRepositoryInterface {
	public function findAllByUserUuid(UuidInterface $userUuid);
	public function add(OrderViewInterface $orderView);
}