<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Application\Command\User\Remove;


use Ramsey\Uuid\UuidInterface;

class RemoveCommand {

	/** @var  UuidInterface */
	public $uuid;

	/**
	 * RemoveCommand constructor.
	 *
	 * @param UuidInterface $uuid
	 */
	public function __construct(UuidInterface $uuid) {
		$this->uuid = $uuid;
	}


}