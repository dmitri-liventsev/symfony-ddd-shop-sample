<?php

namespace App\Infrastructure\Order\Entity;

use App\Domain\Order\Projection\CustomerViewInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class Customer implements CustomerViewInterface {
	/** @var UuidInterface  */
	private $uuid;

	/** @var UuidInterface */
	private $userUuid;

	/**
	 * Customer constructor.
	 *
	 * @param $userUuid
	 * @param string|UuidInterface $uuid
	 */
	public function __construct($userUuid, $uuid) {
		$this->uuid = is_string($uuid) ? Uuid::fromString($uuid) : $uuid;
		$this->userUuid = $userUuid;
	}

	/**
	 * @return mixed
	 */
	public function getUserUuid() {
		return $this->userUuid;
	}

	/**
	 * @param mixed $userUuid
	 */
	public function setUserUuid($userUuid) {
		$this->userUuid = $userUuid;
	}

	/**
	 * @throws \Assert\AssertionFailedException
	 */
	public static function deserialize(array $data): self
	{
		return new self($data["uuid"], $data["user_uuid"]);
	}

	public function serialize() {
		return [
			'uuid' => $this->getUuid()->toString(),
			'user_uuid' => $this->getUserUuid()->toString(),
		];
	}

	/**
	 * @return UuidInterface
	 */
	public function getUuid(): UuidInterface {
		return $this->uuid;
	}

	/**
	 * @param UuidInterface $uuid
	 */
	public function setUuid(UuidInterface $uuid) {
		$this->uuid = $uuid;
	}
}