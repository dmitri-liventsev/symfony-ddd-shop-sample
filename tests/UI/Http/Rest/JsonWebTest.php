<?php
/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */

namespace App\Tests\UI\Http\Rest;


use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class JsonWebTest extends WebTestCase {
	/** @var  Application $application */
	protected static $application;

	/** @var  Client $client */
	protected $client;

	/** @var  EntityManager $entityManager */
    protected $entityManager;

    /** @var Registry */
    protected $doctrine;

    /**
     * @throws \Exception
     */
    public function setUp()
	{
        $this->client = static::createClient();
        $this->doctrine = self::$container->get('doctrine');


        $this->client = static::createClient();
        $this->entityManager = self::$container->get('doctrine.orm.entity_manager');

        self::runCommand('doctrine:fixtures:load');

        parent::setUp();
	}

    /**
     * @param $command
     * @return int
     * @throws \Exception
     */
    protected static function runCommand($command)
	{
		$command = sprintf('%s --quiet', $command);

		return self::getApplication()->run(new StringInput($command));
	}

	protected static function getApplication()
	{
		if (null === self::$application) {
			$client = static::createClient();

			self::$application = new Application($client->getKernel());
			self::$application->setAutoExit(false);
		}

		return self::$application;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function tearDown()
	{
		parent::tearDown();

		$this->entityManager->close();
		$this->entityManager = null; // avoid memory leaks
		$this->client = null; // avoid memory leaks
	}
}