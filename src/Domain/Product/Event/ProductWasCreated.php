<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Product\Event;


use Broadway\Serializer\Serializable;

class ProductWasCreated implements Serializable{
	private $uuid;
	private $name;
	private $type;

	/**
	 * ProductWasCreated constructor.
	 *
	 * @param $uuid
	 * @param $name
	 * @param $type
	 */
	public function __construct($uuid, $name, $type) {
		$this->uuid = $uuid;
		$this->name = $name;
		$this->type = $type;
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