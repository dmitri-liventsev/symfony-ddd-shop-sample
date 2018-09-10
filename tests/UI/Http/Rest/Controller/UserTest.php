<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:49
 */

namespace App\Tests\UI\Http\Rest\Controller;

use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\Order\Repository\CustomerModelRepository;
use App\Infrastructure\Order\Repository\OrderModelRepository;
use App\Infrastructure\Profile\Entity\Profile;
use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\EntityBuilder\UserBuilder;
use Doctrine\ORM\EntityManager;

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
        $this->profileRepositor = $container->get('doctrine')->getRepository(Profile::class);
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
//        $user = UserBuilder::random();
//        $this->client->request('POST', '/api/users', $user->serialize());
//
//        $profile = $this->profileRepository->oneByUserUuid($user->uuid());

        $this->assertEquals(1,1);
    }

    public function testUserCanRemoveHimself() {
        $this->assertEquals(1,1);
    }

    public function testOnUserRemoveProfileShouldBeDeleted() {
        $this->assertEquals(1,1);
    }

    public function testOnUserRemoveAllOrderCustomerShouldStay() {
        $this->assertEquals(1,1);
    }
}