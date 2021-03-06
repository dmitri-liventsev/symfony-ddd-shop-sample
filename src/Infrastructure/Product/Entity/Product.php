<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Product\Entity;

use App\Domain\Product\Projection\ProductViewInterface;
use App\Domain\Product\ValueObject\Name;
use App\Infrastructure\Product\Exception\NumberOnStockIsLessThanZero;
use Broadway\Serializer\Serializable;
use JsonSerializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


class Product implements ProductViewInterface, JsonSerializable {

	/** @var  UuidInterface */
	private $uuid;

	/** @var Name */
	private $name;

	/** @var int */
	private $productsOnStock;

	/** @var  String */
	private $productType;

	/** @var int */
	private $price;

    /**
     * Product constructor.
     * @param $uuid
     * @param string $name
     * @param int $productsOnStock
     * @param $productType
     * @param int $price
     */
	public function __construct($uuid, string $name, int $productsOnStock, $productType, int $price) {
		$this->uuid = is_string($uuid) ? Uuid::fromString($uuid) : $uuid;
		$this->name = $name;
		$this->productsOnStock = $productsOnStock;
		$this->productType = $productType;
		$this->price = $price;
	}

	public static function fromSerializable(Serializable $event): self
	{
		return self::deserialize($event->serialize());
	}

	public static function deserialize($data) {
		$productOnStock = $data["product_on_stock"] ?? 0;
		return new self($data["uuid"], $data["name"], $productOnStock, $data["type"], $data["price"]);
	}

	public function serialize() : array {
		return [
			'uuid' => $this->getUuid()->toString(),
			'name' => $this->name,
			'product_on_stock' => $this->productsOnStock,
			'type' => $this->productType,
			'price' => $this->price,
		];
	}

	public function getUuid(): UuidInterface {
		return $this->uuid;
	}

    /**
     * @param int $amount
     * @throws NumberOnStockIsLessThanZero
     */
    public function reduceNumberOfProductsOnStock(int $amount): void {
		$this->productsOnStock -= $amount;
		if ($this->productsOnStock < 0) {
			throw new NumberOnStockIsLessThanZero();
		}
	}

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getProductsOnStock(): int
    {
        return $this->productsOnStock;
    }

    /**
     * @param int $productsOnStock
     */
    public function setProductsOnStock(int $productsOnStock): void
    {
        $this->productsOnStock = $productsOnStock;
    }

    /**
     * @return String
     */
    public function getProductType(): String
    {
        return $this->productType;
    }

    /**
     * @param String $productType
     */
    public function setProductType(String $productType): void
    {
        $this->productType = $productType;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

	/**
	 * Specify data which should be serialized to JSON
	 * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
	 * @return mixed data which can be serialized by <b>json_encode</b>,
	 * which is a value of any type other than a resource.
	 * @since 5.4.0
	 */
    public function jsonSerialize() {
		return $this->serialize();
	}
}