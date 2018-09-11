<?php

namespace App\Tests\DataFixtures;

use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;

/**
 * @author Dmitri Liventsev <dmitri.liventsev@tacticrealtime.com>
 */
class VoidFixture extends \Doctrine\Common\DataFixtures\AbstractFixture implements ORMFixtureInterface {

	/**
	 * Load data fixtures with the passed EntityManager
	 *
	 * @param \Doctrine\Common\Persistence\ObjectManager $manager
	 */
	public function load(\Doctrine\Common\Persistence\ObjectManager $manager) {
		// TODO: Implement load() method.
	}
}