<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:49
 */

namespace App\Tests\UI\Http\Rest\Controller;

use App\Domain\Order\Repository\OrderModelRepositoryInterface;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\Order\Entity\Order;
use App\Infrastructure\Profile\Entity\Profile;
use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\Command;
use App\Tests\Helper\EntityBuilder\ProductBuilder;
use App\Tests\Helper\EntityBuilder\ProfileBuilder;
use App\Tests\Helper\EntityBuilder\UserBuilder;
use App\Tests\UI\Http\Rest\JsonWebTest;
use Doctrine\ORM\EntityManager;
use Ramsey\Uuid\Uuid;


class UserTest extends JsonWebTest
{
    /** @var EntityManager */
    private $em;

    /** @var UserModelRepositoryInterface */
    private $userRepository;

    /** @var ProfileModelRepositoryInterface */
    private $profileRepository;

    /** @var OrderModelRepositoryInterface */
    private $orderRepository;

    public function setUp() {
    	parent::setUp();

        $client = static::createClient();

        $doctrine = self::$container->get('doctrine');
        $this->em = $doctrine->getManager();
        $this->userRepository = self::$container->get('doctrine')->getRepository(User::class);
        $this->profileRepository = self::$container->get('doctrine')->getRepository(Profile::class);
        $this->orderRepository = self::$container->get('doctrine')->getRepository(Order::class);
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

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testUserCanRemoveHimself() {
	    $user = UserBuilder::random();
	    $profile = ProfileBuilder::random($user);

	    $client = static::createClient();
	    Command::createUser($user, $client);
	    $client->request('DELETE', '/api/user/' . $user->uuid()->toString());

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());

	    /** @var User $actualUser */
	    $actualUser = $this->userRepository->findOneByUuid($user->uuid());
        $this->assertNull($actualUser);
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testOnUserRemoveProfileShouldBeDeleted() {
	    $user = UserBuilder::random();
	    $client = static::createClient();

	    Command::createUser($user, $client);
	    $client->request('DELETE', '/api/user/' . $user->uuid()->toString());

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());

	    /** @var User $actualUser */
	    $profile = $this->profileRepository->findOneByUserUuid($user->uuid());
	    $this->assertNull($profile);
    }

    /**
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function testOnUserRemoveAllOrderCustomerShouldStay() {
	    $client = static::createClient();

	    $user = UserBuilder::random();
	    $product = ProductBuilder::random();
	    $orderUuid = Uuid::uuid4();
	    Command::createUser($user, $client);
	    Command::createProduct($product, $client);
        Command::purchaseProduct($orderUuid, $user, $product, 1, $client);

        $client->request('DELETE', '/api/user/' . $user->uuid()->toString());
        $actualOrder = $this->orderRepository->findOneByUuid($orderUuid);

        $this->assertNotNull($actualOrder);
    }
}