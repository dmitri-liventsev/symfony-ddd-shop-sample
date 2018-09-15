<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product;


use App\Domain\Product\Event\ProductWasCreated;
use App\Domain\Product\ValueObject\Name;
use App\Domain\Product\ValueObject\Price;
use App\Domain\Product\ValueObject\ProductOnStock;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Product extends EventSourcedAggregateRoot {
	/** @var UuidInterface */
	private $uuid;
	/** @var  Name */
	private $name;
	/** @var  string */
	private $type;
	/** @var  Price */
	private $price;

	/**
	 * @return string
	 */
	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}

	public static function create(UuidInterface $uuid, Name $name, ProductOnStock $productOnStock, $type, Price $price) : self {
		$product = new self();
		$product->apply(new ProductWasCreated($uuid, $name, $productOnStock, $type, $price));

		return $product;
	}

	protected function applyProductWasCreated(ProductWasCreated $event): void
	{
		$this->uuid = $event->uuid;

		$this->setName($event->name);
		$this->setType($event->type);
		$this->setPrice($event->price);
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface {
		return $this->uuid;
	}

	/**
	 * @param UuidInterface $uuid
	 */
	public function setUuid(UuidInterface $uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * @return Name
	 */
	public function getName(): Name {
		return $this->name;
	}

	/**
	 * @param Name $name
	 */
	public function setName(Name $name) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getType(): string {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType(string $type) {
		$this->type = $type;
	}

	/**
	 * @return Price
	 */
	public function getPrice(): Price {
		return $this->price;
	}

	/**
	 * @param int $price
	 */
	public function setPrice(Price $price) {
		$this->price = $price;
	}
}