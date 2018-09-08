<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Domain\Profile\Repository;

use App\Domain\Profile\Projection\ProfileViewInterface;
use Ramsey\Uuid\UuidInterface;

interface ProfileModelRepositoryInterface {
	public function oneByUserUuid(UuidInterface $uuid) : ProfileViewInterface;
	public function remove(ProfileViewInterface $profile);
	public function add(ProfileViewInterface $profile);
}