<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product;


use App\Domain\Product\Event\ProductWasCreated;
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

	public static function create(UuidInterface $uuid, $name, $type) : self {
		$order = new self();
		$order->apply(new ProductWasCreated($uuid, $name, $type));
	}
}