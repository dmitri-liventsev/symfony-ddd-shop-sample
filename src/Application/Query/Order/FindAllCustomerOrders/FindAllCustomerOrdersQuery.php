<?php

namespace App\Application\Query\Order\FindAllCustomerOrders;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class FindAllCustomerOrdersQuery {
	/** @var int  */
	public $page = 0;

	/** @var  UuidInterface */
	public $userUuid;
	/**
	 * FindAllQuery constructor.
	 *
	 * @param int $page
	 * @param string $userUuid
	 */
	public function __construct($page, string $userUuid) {
		$this->page     = $page;
		$this->userUuid = Uuid::fromString($userUuid);
	}

}