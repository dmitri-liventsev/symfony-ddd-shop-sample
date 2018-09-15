<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Tests\Helper;


use App\Application\Command\Order\PurchaseProduct\PurchaseProductCommand;
use App\Application\Command\Product\CreateProduct\CreateProductCommand;
use App\Application\Command\User\SignUp\SignUpCommand;
use App\Infrastructure\Product\Entity\Product;
use App\Infrastructure\User\Entity\User;
use League\Tactician\CommandBus;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Client;

class Command {

    /**
     * @param User $user
     * @param Client $client
     * @throws \Assert\AssertionFailedException
     *
     */
    public static function createUser(User $user, Client $client): void
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

    /**
     * @param Product $product
     * @param Client $client
     */
	public static function createProduct(Product $product, Client $client): void
	{
		$createProductCommand = new CreateProductCommand(
			$product->getUuid()->toString(),
			$product->getName(),
			$product->getProductsOnStock(),
			$product->getProductType(),
            $product->getPrice()
		);

		/** @var CommandBus $commandBus */
		$commandBus = $client->getContainer()->get('tactician.commandbus.command');
		$commandBus->handle($createProductCommand);
	}

	public static function purchaseProduct(UuidInterface $orderUuid, User $user, Product $product, int $amount, Client $client) {
        $purchaseProduct = new PurchaseProductCommand(
            $orderUuid->toString(),
            $user->uuid()->toString(),
            $product->getUuid()->toString(),
            $amount
        );

        /** @var CommandBus $commandBus */
        $commandBus = $client->getContainer()->get('tactician.commandbus.command');
        $commandBus->handle($purchaseProduct);
    }
}