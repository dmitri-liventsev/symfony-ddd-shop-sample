<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\Repository;

use App\Domain\Profile\Profile;
use Ramsey\Uuid\UuidInterface;

interface ProfileStoreInterface {

	public function store(Profile $order): void;

	public function get(UuidInterface $uuid): Profile;
}