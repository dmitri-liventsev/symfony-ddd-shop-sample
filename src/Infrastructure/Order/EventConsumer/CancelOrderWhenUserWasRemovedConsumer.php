<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Infrastructure\Order\EventConsumer;


use App\Domain\User\Event\UserWasRemoved;
use Broadway\ReadModel\Projector;

class CancelOrderWhenUserWasRemovedConsumer extends Projector {

	protected function applyUserWasRemoved(UserWasRemoved $event) {
		//TODO: implement it!
		//Set all not finished orders status to CANCELED
	}
}