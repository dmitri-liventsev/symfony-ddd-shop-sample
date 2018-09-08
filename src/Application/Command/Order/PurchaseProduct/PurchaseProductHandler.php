<?php

namespace App\Application\Command\Order\PurchaseProduct;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\Order\Factory\OrderFactory;
use App\Domain\Order\Repository\OrderStoreInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class PurchaseProductHandler implements CommandHandlerInterface {
	/** @var OrderStoreInterface */
	private $orderStore;

	/** @var  OrderFactory */
	private $orderFactory;


	public function __construct(OrderStoreInterface $orderStore, OrderFactory $orderFactory)
	{
		$this->orderStore = $orderStore;
		$this->orderFactory = $orderFactory;
	}

	public function __invoke(PurchaseProductCommand $command): void
	{
		$this->orderFactory->purchaseProduct($command->uuid, $command->userUuid, $command->productUuid, $command->amount);
	}
}