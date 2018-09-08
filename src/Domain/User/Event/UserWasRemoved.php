<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\User\Event;


use Broadway\Serializer\Serializable;

final class UserWasRemoved  implements Serializable{

	private $uuid;

	/**
	 * UserWasRemoved constructor.
	 *
	 * @param $uuid
	 */
	public function __construct($uuid) {
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