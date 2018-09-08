<?php

namespace App\Application\Command\Order\PurchaseProduct;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class PurchaseProductCommand {
	/** @var UuidInterface */
	public $userUuid;

	/** @var UuidInterface */
	public $productUuid;

	/** @var  int */
	public $amount;

	/** @var UuidInterface  */
	public $uuid;
	/**
	 * PurchaseProductCommand constructor.
	 *
	 * @param UuidInterface $userUuid
	 * @param UuidInterface $productUuid
	 * @param int           $amount
	 */
	public function __construct(string $uuid, UuidInterface $userUuid, UuidInterface $productUuid, $amount) {
		$this->uuid = Uuid::fromString($uuid);
		$this->userUuid    = $userUuid;
		$this->productUuid = $productUuid;
		$this->amount      = $amount;
	}
}