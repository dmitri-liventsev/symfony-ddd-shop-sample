<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\UI\Cli\Command;

use App\Application\Command\Product\CreateProduct\CreateProductCommand;
use League\Tactician\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProductCliCommand extends Command {
	/**
	 * @var CommandBus
	 */
	private $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		parent::__construct();
		$this->commandBus = $commandBus;
	}

	protected function configure(): void
	{
		$this
			->setName('app:create-product')
			->setDescription('Given a uuid, name and type, generates a new product.')
			->addArgument('name', InputArgument::REQUIRED, 'Product name')
			->addArgument('product_on_stock', InputArgument::REQUIRED, 'Product on stock')
			->addArgument('price', InputArgument::OPTIONAL, 'Price')
			->addArgument('type', InputArgument::OPTIONAL, 'Product type')
			->addArgument('uuid', InputArgument::OPTIONAL, 'Product Uuid')
		;
	}

	/**
	 * @throws \Exception
	 * @throws \Assert\AssertionFailedException
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$command = new CreateProductCommand(
			$uuid = ($input->getArgument('uuid') ?: Uuid::uuid4()->toString()),
			$name = $input->getArgument('name'),
			$amount = $input->getArgument('product_on_stock'),
			$type = $input->getArgument('type')?: 'Book',
			$price = $input->getArgument('price')?: 0
		);

		$this->commandBus->handle($command);

		$output->writeln('<info>Product Created: </info>');
		$output->writeln('');
		$output->writeln("Uuid: $uuid");
		$output->writeln("Name: $name");
		$output->writeln("Type: $type");
		$output->writeln("Amount: $amount");
	}
}