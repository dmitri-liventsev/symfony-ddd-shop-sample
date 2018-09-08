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
	 * @param string $userUuid
	 * @param string $productUuid
	 * @param int           $amount
	 */
	public function __construct(string $uuid, string $userUuid, string $productUuid, $amount) {
		$this->uuid = Uuid::fromString($uuid);
		$this->userUuid    = Uuid::fromString($userUuid);
		$this->productUuid = Uuid::fromString($productUuid);
		$this->amount      = $amount;
	}
}