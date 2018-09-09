<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 22:15
 */

namespace App\Tests\Functional\Fixtures;

use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\Randomize;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class UserBuilder
{
    /**
     * @return User
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public static function random()
    {
        return User::deserialize([
            'uuid' => Uuid::uuid4(),
            'credentials' => [
                'email' => Randomize::email(),
                'password' => 'qwerty',
            ]
        ]);
    }
}