<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:49
 */

namespace App\Tests\UI\Http\Rest\Controller;

use App\Domain\Order\Projection\OrderViewInterface;
use App\Domain\Order\Repository\OrderModelRepositoryInterface;
use App\Domain\Product\Projection\ProductViewInterface;
use App\Domain\Product\Repository\ProductModelRepositoryInterface;
use App\Domain\Profile\Repository\ProfileModelRepositoryInterface;
use App\Domain\User\Repository\UserModelRepositoryInterface;
use App\Infrastructure\Order\Entity\Order;
use App\Infrastructure\Product\Entity\Product;
use App\Infrastructure\Profile\Entity\Profile;
use App\Infrastructure\User\Entity\User;
use App\Tests\Helper\Command;
use App\Tests\Helper\EntityBuilder\ProductBuilder;
use App\Tests\Helper\EntityBuilder\UserBuilder;
use App\Tests\UI\Http\Rest\JsonWebTest;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderTest extends JsonWebTest
{
    /** @var UserModelRepositoryInterface */
    private $userRepository;

    /** @var OrderModelRepositoryInterface */
    private $orderRepository;

    /** @var ProductModelRepositoryInterface */
    private $productRepository;

    public function setUp() {
        parent::setUp();

        $this->userRepository = $this->doctrine->getRepository(User::class);
        $this->orderRepository = $this->doctrine->getRepository(Order::class);
        $this->productRepository = $this->doctrine->getRepository(Product::class);
    }

    /**
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function testUserCanPurchaseProduct() {
        $client = static::createClient();

        $user = UserBuilder::random();
        $product = ProductBuilder::random();
        $orderUuid = Uuid::uuid4();
        $amount = 3;
        Command::createUser($user, $client);
        Command::createProduct($product, $client);

        $client->request('POST', '/api/purchase', [
            'user_uuid' => $user->uuid()->toString(),
            'product_uuid' => $product->getUuid()->toString(),
            'amount' => $amount,
            'uuid' => $orderUuid
        ]);

        /** @var OrderViewInterface $actualOrder */
        $actualOrder = $this->orderRepository->findOneByUuid($orderUuid);

        $this->assertNotNull($actualOrder);
        $this->assertEquals($amount, $actualOrder->getOrderItem()->getAmount());
	}

    /**
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function testNumberProductsOnStockShouldBeReducedAfterPurchasing() {
        $client = static::createClient();

        $user = UserBuilder::random();
        $product = ProductBuilder::random();
        $amount = 1;

        Command::createUser($user, $client);
        Command::createProduct($product, $client);

        $client->request('POST', '/api/purchase', [
            'user_uuid' => $user->uuid()->toString(),
            'product_uuid' => $product->getUuid()->toString(),
            'amount' => $amount,
        ]);

        /** @var ProductViewInterface $actualProduct */
        $actualProduct = $this->productRepository->findOneByUuid($product->getUuid());

        $this->assertLessThan($product->getProductsOnStock(), $actualProduct->getProductsOnStock());
    }

    /**
     * @throws \Assert\AssertionFailedException
     * @throws \Exception
     */
    public function testCanBeGetListOfOrders() {
        $client = static::createClient();

        $user = UserBuilder::random();
        $product1 = ProductBuilder::random();
        $product2 = ProductBuilder::random();
        $orderUuids = [Uuid::uuid4(), Uuid::uuid4()];

        Command::createUser($user, $client);
        Command::createProduct($product1, $client);
        Command::createProduct($product2, $client);
        Command::purchaseProduct($orderUuids[0], $user, $product1, 1, $client);
        Command::purchaseProduct($orderUuids[1], $user, $product2, 1, $client);

        $client->request('GET', '/api/orders/' . $user->uuid()->toString() . '/1');

        $contentString = $client->getResponse()->getContent();
        $contentStdClass = json_decode($contentString);

        $this->assertEquals(200,$client->getResponse()->getStatusCode());
        $this->assertEquals(2, $contentStdClass->total);
        $this->assertTrue(in_array( $contentStdClass->data[0]->uuid, $orderUuids));
        $this->assertTrue(in_array( $contentStdClass->data[1]->uuid, $orderUuids));
    }
}