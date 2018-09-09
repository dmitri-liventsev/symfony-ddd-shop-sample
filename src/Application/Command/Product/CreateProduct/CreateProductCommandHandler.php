<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Product\CreateProduct;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Repository\ProductStoreInterface;

class CreateProductCommandHandler implements CommandHandlerInterface {
	/** @var ProductStoreInterface */
	private $productStore;

	/** @var  ProductFactory */
	private $productFactory;


	public function __construct(ProductStoreInterface $orderStore, ProductFactory $orderFactory)
	{
		$this->productStore   = $orderStore;
		$this->productFactory = $orderFactory;
	}

	public function __invoke(CreateProductCommand $command): void
	{
		$product = $this->productFactory->create($command->uuid, $command->name, $command->type, $command->price);
		$this->productStore->store($product);
	}
}