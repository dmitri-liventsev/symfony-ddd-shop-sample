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
}