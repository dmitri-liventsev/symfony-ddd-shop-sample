<?php declare(strict_types=1);

namespace App\Infrastructure\Common\Migrations;

use Broadway\EventStore\Dbal\DBALEventStore;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180908190647 extends AbstractMigration implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function up(Schema $schema)
    {
        $this->eventStore = $this->container->get(DBALEventStore::class);
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->eventStore->configureSchema($schema);

        $this->em->flush();
    }

    public function down(Schema $schema)
    {
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $schema->dropTable('api.events');

        $this->em->flush();
    }

    /** @var EntityManager */
    private $em;

    /** @var DBALEventStore */
    private $eventStore;
}
