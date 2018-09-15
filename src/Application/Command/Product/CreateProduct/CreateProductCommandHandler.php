<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Product\CreateProduct;

use App\Application\Command\CommandHandlerInterface;
use App\Domain\Product\Factory\ProductFactory;
use App\Domain\Product\Repository\ProductStoreInterface;
use App\Domain\Product\ValueObject\Name;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductOnStock;

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
	    $name = Name::fromString($command->name);
	    $productOnStock = ProductOnStock::fromString($command->productOnStock);
	    $price = Price::fromString($command->price);

		$product = $this->productFactory->create($command->uuid, $name, $productOnStock, $command->type, $price);
		$this->productStore->store($product);
	}
}