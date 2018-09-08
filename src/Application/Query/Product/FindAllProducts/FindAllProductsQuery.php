<?php

namespace App\Application\Query\Product\PurchaseProduct;

use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class FindAllProductsQuery {
	/** @var int  */
	public $page = 0;

	/** @var  UuidInterface */
	public $userUuid;
	/**
	 * FindAllQuery constructor.
	 *
	 * @param int $page
	 */
	public function __construct($page, UuidInterface $userUuid) {
		$this->page     = $page;
		$this->userUuid = $userUuid;
	}

}