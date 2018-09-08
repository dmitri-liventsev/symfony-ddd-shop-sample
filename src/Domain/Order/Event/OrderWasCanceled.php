<?php

namespace App\Domain\Order\Event;
use App\Domain\Order\Entity\Customer;
use App\Domain\Order\Entity\OrderItem;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class OrderWasCanceled implements Serializable {

	/**
	 * @var UuidInterface
	 */
	public $uuid;

	/**
	 * OrderWasCreated constructor.
	 */
	public function __construct(UuidInterface $uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * @return mixed The object instance
	 */
	public static function deserialize(array $data) {
		// TODO: Implement deserialize() method.
	}

	/**
	 * @return array
	 */
	public function serialize(): array {
		// TODO: Implement serialize() method.
	}
}