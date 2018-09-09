<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product;


use App\Domain\Product\Event\ProductWasCreated;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Product extends EventSourcedAggregateRoot {
	/** @var UuidInterface */
	private $uuid;
	/** @var  string */
	private $name;
	/** @var  string */
	private $type;
	/** @var  int */
	private $price;

	/**
	 * @return string
	 */
	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}

	public static function create(UuidInterface $uuid, $name, $type, $price) : self {
		$product = new self();
		$product->apply(new ProductWasCreated($uuid, $name, $type, $price));

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
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name) {
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
	 * @return int
	 */
	public function getPrice(): int {
		return $this->price;
	}

	/**
	 * @param int $price
	 */
	public function setPrice(int $price) {
		$this->price = $price;
	}
}