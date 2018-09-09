<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\User\Event;

use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserWasRemoved  implements Serializable{

	/** @var  UuidInterface */
	public $uuid;

	/**
	 * UserWasRemoved constructor.
	 *
	 * @param $uuid
	 */
	public function __construct(UuidInterface $uuid) {
		$this->uuid = $uuid;
	}

	/**
	 * @return mixed The object instance
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