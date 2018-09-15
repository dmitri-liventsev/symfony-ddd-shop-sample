<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Tests\Helper\EntityBuilder;


use App\Infrastructure\Profile\Entity\Profile;
use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\Randomize;
use Ramsey\Uuid\Uuid;

class ProfileBuilder {
	/**
	 * @return Profile
	 * @throws \Assert\AssertionFailedException
	 * @throws \Exception
	 */
	public static function random(User $user)
	{
		return Profile::deserialize([
			'uuid' => Uuid::uuid4(),
			'user_uuid' => $user->uuid(),
			'Address' => [
				'city' => Randomize::string(),
				'street' => Randomize::string(),
				'house_number' => Randomize::number(),
			],
		    'contact' => [
		    	'email' => Randomize::email(),
		    	'phone' => Randomize::number(100000, 999999)
		    ]
		]);
	}
}