<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Entity;


use Ramsey\Uuid\UuidInterface;

class OrderItem {
	/** @var  UuidInterface */
	private $uuid;

	/** @var  UuidInterface */
	private $productUuid;

	/** @var  int */
	private $amount;

	/**
	 * OrderItem constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param UuidInterface $productUuid
	 * @param int           $amount
	 */
	public function __construct(UuidInterface $uuid, UuidInterface $productUuid, $amount) {
		$this->uuid        = $uuid;
		$this->productUuid = $productUuid;
		$this->amount      = $amount;
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
	 * @return UuidInterface
	 */
	public function getProductUuid(): UuidInterface {
		return $this->productUuid;
	}

	/**
	 * @param UuidInterface $productUuid
	 */
	public function setProductUuid(UuidInterface $productUuid) {
		$this->productUuid = $productUuid;
	}

	/**
	 * @return int
	 */
	public function getAmount(): int {
		return $this->amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(int $amount) {
		$this->amount = $amount;
	}


}