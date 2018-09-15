<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Entity;


use App\Domain\Order\ValueObject\OrderItem\Amount;
use Ramsey\Uuid\UuidInterface;

class OrderItem {
	/** @var  UuidInterface */
	private $uuid;

	/** @var  UuidInterface */
	private $productUuid;

	/** @var Amount */
	private $amount;

	/**
	 * OrderItem constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param UuidInterface $productUuid
	 * @param Amount        $amount
	 */
	public function __construct(UuidInterface $uuid, UuidInterface $productUuid, Amount $amount) {
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
	public function getAmount(): Amount {
		return $this->amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(Amount $amount) {
		$this->amount = $amount;
	}


}