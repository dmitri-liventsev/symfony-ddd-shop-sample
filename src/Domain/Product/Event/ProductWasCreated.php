<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product\Event;


use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProductWasCreated implements Serializable {
	/** @var  UuidInterface */
	public $uuid;
	/** @var  string */
	public $name;
	/** @var  string */
	public $type;
	/** @var  int */
	public $price;
	/** @var  int */
	public $productOnStock;

	/**
	 * ProductWasCreated constructor.
	 *
	 * @param $uuid
	 * @param $name
	 * @param $type
	 */
	public function __construct(UuidInterface $uuid, $name, $productOnStock, $type, $price) {
		$this->uuid           = $uuid;
		$this->name           = $name;
		$this->productOnStock = $productOnStock;
		$this->type           = $type;
		$this->price          = $price;
	}

	/**
	 * @return mixed The object instance
	 */
	public static function deserialize(array $data) {
		return new self(
			Uuid::fromString($data['uuid']),
			$data['name'],
			$data['product_on_stock'],
			$data['type'],
			$data['price']
		);
	}

	/**
	 * @return array
	 */
	public function serialize(): array {
		return [
			'uuid' => $this->uuid->toString(),
			'name' => $this->name,
			'product_on_stock' => $this->productOnStock,
			'type' => $this->type,
			'price' => $this->price,
		];
	}
}