<?php

namespace App\Application\Query\Product\PurchaseProduct;

use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class FindAllProductsQuery {
	/** @var int  */
	public $page = 0;

	/**
	 * FindAllQuery constructor.
	 *
	 * @param int $page
	 */
	public function __construct($page) {
		$this->page     = $page;
	}

}