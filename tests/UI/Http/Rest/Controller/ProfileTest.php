<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:50
 */

namespace App\Tests\UI\Http\Rest\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileTest extends WebTestCase
{
    public function testProfileCanBeChanged() {
        $this->assertEquals(1,1);
    }
}