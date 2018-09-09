<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Order\Entity;


use Ramsey\Uuid\UuidInterface;

class Customer {
	/** @var  UuidInterface */
	private $uuid;

	/** @var  UuidInterface */
	private $userUuid;

	/**
	 * Customer constructor.
	 *
	 * @param UuidInterface $uuid
	 * @param UuidInterface $userUuid
	 */
	public function __construct(UuidInterface $uuid, UuidInterface $userUuid) {
		$this->uuid     = $uuid;
		$this->userUuid = $userUuid;
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

	/**
	 * @return UuidInterface
	 */
	public function getUserUuid(): UuidInterface {
		return $this->userUuid;
	}

	/**
	 * @param UuidInterface $userUuid
	 */
	public function setUserUuid(UuidInterface $userUuid) {
		$this->userUuid = $userUuid;
	}


}