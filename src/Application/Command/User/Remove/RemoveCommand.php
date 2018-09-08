<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\User\Remove;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class RemoveCommand {

	/** @var UuidInterface */
	public $uuid;

	/**
	 * RemoveCommand constructor.
	 *
	 * @param string $uuid
	 */
	public function __construct(string $uuid) {
		$this->uuid = Uuid::fromString($uuid);;
	}


}