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
use App\Tests\Helper\EntityBuilder\ProfileBuilder;
use App\Tests\Helper\EntityBuilder\UserBuilder;
use Doctrine\ORM\EntityManager;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    /** @var EntityManager */
    private $em;

    /** @var UserModelRepositoryInterface */
    private $userRepository;

    /** @var ProfileModelRepositoryInterface */
    private $profileRepository;

    public function setUp() {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $this->em = $doctrine->getManager();
        $this->userRepository = $container->get('doctrine')->getRepository(User::class);
        $this->profileRepository = $container->get('doctrine')->getRepository(Profile::class);
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
	    $this->createUser($user, $client);
	    $client->request('DELETE', '/api/user/' . $user->uuid());

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());

	    /** @var User $actualUser */
	    $actualUser = $this->userRepository->findOneByUuid($user->uuid());
        $this->assertNull($actualUser);
    }

    public function testOnUserRemoveProfileShouldBeDeleted() {
	    $user = UserBuilder::random();
	    $client = static::createClient();

	    $this->createUser($user, $client);
	    $client->request('DELETE', '/api/user/' . $user->uuid());

	    $this->assertEquals(200, $client->getResponse()->getStatusCode());

	    /** @var User $actualUser */
	    $profile = $this->profileRepository->findOneByUserUuid($user->uuid());
	    $this->assertNull($profile);
    }

    public function testOnUserRemoveAllOrderCustomerShouldStay() {
        $this->assertEquals(1,1);
    }

	/**
	 * @throws \Assert\AssertionFailedException
	 * @throws \Exception
	 */
	protected function createUser(User $user, $client): void
	{
		$signUp = new SignUpCommand(
			$user->uuid()->toString(),
			$user->email(),
			$user->hashedPassword()
		);

		/** @var CommandBus $commandBus */
		$commandBus = $client->getContainer()->get('tactician.commandbus.command');
		$commandBus->handle($signUp);
	}
}