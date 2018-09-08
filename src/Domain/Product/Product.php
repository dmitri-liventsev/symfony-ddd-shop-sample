<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product;


use Broadway\EventSourcing\EventSourcedAggregateRoot;
use Ramsey\Uuid\UuidInterface;

class Product extends EventSourcedAggregateRoot {
	/** @var UuidInterface */
	private $uuid;

	/**
	 * @return string
	 */
	public function getAggregateRootId(): string
	{
		return $this->uuid->toString();
	}
}