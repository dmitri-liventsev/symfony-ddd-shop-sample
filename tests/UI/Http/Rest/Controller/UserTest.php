<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:49
 */

namespace App\Tests\UI\Http\Rest\Controller;

use App\Application\Command\User\SignUp\SignUpCommand;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\Order\Repository\CustomerModelRepository;
use App\Infrastructure\Order\Repository\OrderModelRepository;
use App\Infrastructure\Profile\Entity\Profile;
use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\Command;
use App\Tests\Helper\EntityBuilder\ProfileBuilder;
use App\Tests\Helper\EntityBuilder\UserBuilder;
use App\Tests\UI\Http\Rest\JsonWebTest;
use Doctrine\ORM\EntityManager;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends JsonWebTest
{
    /** @var EntityManager */
    private $em;

    /** @var UserModelRepositoryInterface */
    private $userRepository;

    /** @var ProfileModelRepositoryInterface */
    private $profileRepository;

    public function setUp() {
    	parent::setUp();

        $client = static::createClient();

        $doctrine = self::$container->get('doctrine');
        $this->em = $doctrine->getManager();
        $this->userRepository = self::$container->get('doctrine')->getRepository(User::class);
        $this->profileRepository = self::$container->get('doctrine')->getRepository(Profile::class);
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testUserCanSignUp() {
        $user = UserBuilder::random();
        $client = static::createClient();
        $client->request('POST', '/api/users', ["email" => $user->email(), "password" => $user->hashedPassword(), "uuid" => $user->uuid()]);
        /** @var User $actualUser */
        $actualUser = $this->userRepository->findOneByUuid($user->uuid());

        $this->assertEquals(201, $client->getResponse()->getStatusCode());
        $this->assertEquals($user->email(), $actualUser->email());
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testOnSignUpProfileShouldBeCreated() {
        $user = UserBuilder::random();

	    $client = static::createClient();
	    $client->request('POST', '/api/users', ["email" => $user->email(), "password" => $user->hashedPassword(), "uuid" => $user->uuid()]);

        $profile = $this->profileRepository->findOneByUserUuid($user->uuid());

        $this->assertNotNull($profile);
    }

    public function testUserCanRemoveHimself() {
	    $user = UserBuilder::random();
	    $profile = ProfileBuilder::random($user);

	    $client = static::createClient();
	    Command::createUser($user, $client);
	    $client->request('DELETE', '/api/user/' . $user->uuid());

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());

	    /** @var User $actualUser */
	    $actualUser = $this->userRepository->findOneByUuid($user->uuid());
        $this->assertNull($actualUser);
    }

    public function testOnUserRemoveProfileShouldBeDeleted() {
	    $user = UserBuilder::random();
	    $client = static::createClient();

	    Command::createUser($user, $client);
	    $client->request('DELETE', '/api/user/' . $user->uuid());

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());

	    /** @var User $actualUser */
	    $profile = $this->profileRepository->findOneByUserUuid($user->uuid());
	    $this->assertNull($profile);
    }

    public function testOnUserRemoveAllOrderCustomerShouldStay() {
    	//TODO implement it!
	    $client = static::createClient();

	    $user = UserBuilder::random();
	    Command::createUser($user, $client);

	    //create product
	    //create order
	    //remove user

	    //check at order not null

        $this->assertEquals(1,1);
    }
}