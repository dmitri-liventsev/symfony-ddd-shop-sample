<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Product\CreateProduct;


use App\Domain\Product\ValueObject\Name;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductOnStock;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CreateProductCommand {
	/** @var UuidInterface  */
    public $uuid;

    /** @var Name  */
	public $name;

	/** @var string */
	public $type;

	/** @var Price  */
	public $price;

	/** @var ProductOnStock  */
	public $productOnStock;

    /**
     * CreateProductCommand constructor.
     * @param string $uuid
     * @param string $name
     * @param int $productOnStock
     * @param $type
     * @param int $price
     */
	public function __construct(string $uuid, string $name, int $productOnStock, $type, int $price) {
		$this->uuid = Uuid::fromString($uuid);
		$this->name = $name;
		$this->type = $type;
		$this->price = $price;
		$this->productOnStock = $productOnStock;
	}
}