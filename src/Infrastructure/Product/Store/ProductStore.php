<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Product\Store;

use App\Domain\Product\Product;
use App\Domain\Product\Repository\ProductStoreInterface;
use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository;
use Broadway\EventStore\EventStore;
use Ramsey\Uuid\UuidInterface;

class ProductStore extends EventSourcingRepository implements ProductStoreInterface{

    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        array $eventStreamDecorators = []
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            Product::class,
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }

	public function store(Product $product) : void {
		$this->save($product);
	}

	public function get(UuidInterface $uuid): Product
	{
		/** @var Product $product */
		$product = $this->load((string) $uuid);

		return $product;
	}
}