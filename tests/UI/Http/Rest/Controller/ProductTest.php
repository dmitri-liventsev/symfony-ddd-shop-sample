<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:50
 */

namespace App\Tests\UI\Http\Rest\Controller;

use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\Profile\Entity\Profile;
use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\Command;
use App\Tests\Helper\EntityBuilder\ProductBuilder;
use App\Tests\UI\Http\Rest\JsonWebTest;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductTest extends JsonWebTest
{
    /** @var UserModelRepositoryInterface */
    private $userRepository;

    /** @var ProfileModelRepositoryInterface */
    private $profileRepository;

    public function setUp() {
        parent::setUp();

        $this->userRepository = $this->doctrine->getRepository(User::class);
        $this->orderRepository = $this->doctrine->getRepository(Profile::class);
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    public function testCanBeGetListOfProducts() {
        $client = static::createClient();

        $product1 = ProductBuilder::random();
        $product2 = ProductBuilder::random();

        $productUuids = [$product1->getUuid(), $product2->getUuid()];

        Command::createProduct($product1, $client);
        Command::createProduct($product2, $client);

        $client->request('GET', '/api/products/1');

        $contentString = $client->getResponse()->getContent();
        $contentStdClass = json_decode($contentString);

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertEquals(2, $contentStdClass->total);
        $this->assertTrue(in_array( $contentStdClass->data[0]->uuid, $productUuids));
        $this->assertTrue(in_array( $contentStdClass->data[1]->uuid, $productUuids));
    }
}