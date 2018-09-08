<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Product\Entity;

use App\Domain\Product\Projection\ProductViewInterface;
use App\Infrastructure\Product\Exception\NumberOnStockIsLessThanZero;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Serializable;

class Product implements ProductViewInterface {

	/** @var  UuidInterface */
	private $uuid;

	/** @var int */
	private $productsOnStock;

	/** @var  String */
	private $productType;

	/**
	 * Product constructor.
	 *
	 * @param $uuid
	 * @param $productsOnStock
	 * @param $productType
	 */
	public function __construct($uuid, $productsOnStock, $productType) {
		$this->uuid = is_string($uuid) ? Uuid::fromString($uuid) : $uuid;
		$this->productsOnStock = $productsOnStock;
		$this->productType = $productType;
	}

	public static function fromSerializable(Serializable $event): self
	{
		return self::deserialize($event->serialize());
	}

	public static function deserialize($data) {
		return new self($data["uuid"], $data["products_on_stock"], $data["product_type"]);
	}

	public function getUuid(): UuidInterface {
		return $this->uuid;
	}

	public function reduceNumberOfProductsOnStock(int $amount): void {
		$this->productsOnStock -= $amount;
		if ($this->productsOnStock < 0) {
			throw new NumberOnStockIsLessThanZero();
		}
	}
}