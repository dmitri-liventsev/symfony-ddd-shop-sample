<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\Product\CreateProduct;


use Ramsey\Uuid\Uuid;

class CreateProductCommand {
	public $uuid;
	public $name;
	public $type;

	/**
	 * CreateProductCommandHandler constructor.
	 *
	 * @param string $uuid
	 * @param $name
	 * @param $type
	 */
	public function __construct(string $uuid, $name, $type) {
		$this->uuid = Uuid::fromString($uuid);
		$this->name = $name;
		$this->type = $type;
	}
}