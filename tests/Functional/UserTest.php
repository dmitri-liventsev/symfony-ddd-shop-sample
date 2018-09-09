<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:49
 */

namespace App\Tests\Functional;

use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\Order\Repository\CustomerModelRepository;
use App\Infrastructure\Order\Repository\OrderModelRepository;
use App\Tests\Functional\Fixtures\UserBuilder;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Client;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    /** @var EntityManager */
    private $em;

    /** @var Client */
    private $client;

    /** @var UserModelRepositoryInterface */
    private $userRepository;

    /** @var ProfileModelRepositoryInterface */
    private $profileRepository;

    /** @var OrderModelRepository */
    private $orderCustomerRepository;

    public function setUp() {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $this->em = $doctrine->getManager();
        $this->userRepository = $container->get(UserModelRepositoryInterface::class);
        $this->profileRepository = $container->get(ProfileModelRepositoryInterface::class);
        $this->orderCustomerRepository = $this->em->getRepository(CustomerModelRepository::class);

        $this->client = static::createClient();
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testUserCanSignUp() {
        $user = UserBuilder::random();
        $this->client->request('POST', '/api/users', $user->serialize());
        $actualUser = $this->userRepository->oneByUuid($user->uuid());

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals($user->email(), $actualUser->email());
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testOnSignUpProfileShouldBeCreated() {
        $user = UserBuilder::random();
        $this->client->request('POST', '/api/users', $user->serialize());

        $profile = $this->profileRepository->oneByUserUuid($user->uuid());
    }

    public function testUserCanRemoveHimself() {

    }

    public function testOnUserRemoveProfileShouldBeDeleted() {

    }

    public function testOnUserRemoveAllOrderCustomerShouldStay() {

    }
}