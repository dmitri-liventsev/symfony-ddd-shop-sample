<?php

namespace App\Infrastructure\Order\Entity;
use App\Domain\Order\Projection\OrderItemViewInterface;
use App\Domain\Product\Entity\ProductViewInterface;
use App\Infrastructure\Product\Entity\Product;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderItem implements OrderItemViewInterface {

	/** @var UuidInterface */
	private $uuid;

	/** @var UuidInterface */
	private $productUuid;

	/** @var  int */
	private $amount;

	/**
	 * OrderItem constructor.
	 *
	 * @param string|UuidInterface $productUuid
	 * @param string|UuidInterface $uuid
	 * @param int     $amount
	 */
	public function __construct(UuidInterface $productUuid, int $amount, $uuid) {
		$this->uuid = is_string($uuid) ? Uuid::fromString($uuid) : $uuid;
		$this->productUuid = is_string($productUuid) ? Uuid::fromString($productUuid) : $productUuid;

		$this->amount  = $amount;
	}

	public function getProductUuid(): UuidInterface {
		return $this->productUuid;
	}

	public function getAmount(): int {
		return $this->amount;
	}

    /**
     * @param array $data
     * @return OrderItem
     */
	public static function deserialize(array $data): self
	{
		return new self(Uuid::fromString($data["product_uuid"]), $data["amount"], Uuid::fromString($data["uuid"]));
	}

	public function serialize() {
		return [
			'uuid' => $this->getUuid()->toString(),
			'amount' => $this->getAmount(),
			'product_uuid' => $this->getProductUuid()->toString(),
		];
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
}