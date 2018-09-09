<?php

namespace App\Domain\Order\Event;
use App\Domain\Order\Entity\Customer;
use App\Domain\Order\Entity\OrderItem;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
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
	 * @return OrderWasCanceled The object instance
	 */
	public static function deserialize(array $data) {
		return new self(Uuid::fromString($data['uuid']));
	}

	/**
	 * @return array
	 */
	public function serialize(): array {
		return ['uuid' => $this->uuid->toString()];
	}
}