<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Product\CreateProduct;


use Ramsey\Uuid\Uuid;

class CreateProductCommand {
	public $uuid;
	public $name;
	public $type;
	public $price;
	public $productOnStock;

	/**
	 * CreateProductCommandHandler constructor.
	 *
	 * @param string $uuid
	 * @param        $name
	 * @param        $productOnStock
	 * @param        $type
	 * @param        $price
	 */
	public function __construct(string $uuid, $name, $productOnStock, $type, $price) {
		$this->uuid = Uuid::fromString($uuid);
		$this->name = $name;
		$this->type = $type;
		$this->price = $price;
		$this->productOnStock = $productOnStock;
	}
}