<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:50
 */

namespace App\Tests\UI\Http\Rest\Controller;

use App\Domain\Profile\Projection\ProfileViewInterface;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Infrastructure\Profile\Entity\Profile;
use App\Tests\Helper\Command;
use App\Tests\Helper\EntityBuilder\ProfileBuilder;
use App\Tests\Helper\EntityBuilder\UserBuilder;
use App\Tests\UI\Http\Rest\JsonWebTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileTest extends JsonWebTest
{

    /** @var ProfileModelRepositoryInterface */
    private $profileRepository;

    public function setUp() {
        parent::setUp();

        $this->profileRepository = $this->doctrine->getRepository(Profile::class);
    }
    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testProfileCanBeChanged() {
    	//Create user
        $user = UserBuilder::random();
        $newProfile = ProfileBuilder::random($user);

        $client = static::createClient();
        Command::createUser($user, $client);

        $client->request('PUT', '/api/profile/' . $user->uuid()->toString(), [
            'address_city' => $newProfile->getAddress()->getCity(),
            'address_street' =>  $newProfile->getAddress()->getStreet(),
            'address_house_number' =>  $newProfile->getAddress()->getHouseNumber(),

            'contact_email' =>  $newProfile->getContact()->getEmail(),
            'contact_phone' =>  $newProfile->getContact()->getPhone(),
        ]);

        /** @var ProfileViewInterface $profile */
        $profile = $this->profileRepository->findOneByUserUuid($user->uuid());

        $this->assertEquals($profile->getAddress()->getCity(),$newProfile->getAddress()->getCity());
        $this->assertEquals($profile->getAddress()->getStreet(),$newProfile->getAddress()->getStreet());
        $this->assertEquals($profile->getAddress()->getHouseNumber(),$newProfile->getAddress()->getHouseNumber());

        $this->assertEquals($profile->getContact()->getPhone(),$newProfile->getContact()->getPhone());
        $this->assertEquals($profile->getContact()->getEmail(),$newProfile->getContact()->getEmail());
    }
}