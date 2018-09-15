<?php

namespace App\Application\Command\Order\PurchaseProduct;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\Order\Factory\OrderFactory;
use App\Domain\Order\Repository\OrderStoreInterface;
use App\Domain\Order\ValueObject\OrderItem\Amount;

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

    /**
     * @param PurchaseProductCommand $command
     * @throws \Exception
     */
    public function __invoke(PurchaseProductCommand $command): void
	{
	    $amount = Amount::fromInt($command->amount);
        $order = $this->orderFactory->purchaseProduct($command->uuid, $command->userUuid, $command->productUuid, $amount);
		$this->orderStore->store($order);
	}
}