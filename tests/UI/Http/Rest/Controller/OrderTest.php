<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 21:49
 */

namespace App\Tests\UI\Http\Rest\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderTest extends WebTestCase
{
	public function testUserCanPurchaseProduct() {
		//Create user
		//Create product
		//Purchase products via API
		//Check order

		$this->assertEquals(1,1);
	}

    public function testCanBeGetListOfOrders() {
    	//Create user
	    //Create product
	    //Purchase products via API
	    //Check orders number and orders !?!? Need to drop DB before using

        $this->assertEquals(1,1);
    }

    public function testNumberProductsOnStockShouldBeReducedAfterPurchasing() {
    	//Create user
	    //Create product witch amount
	    //Purchase products via API
	    //Check product should contain reduced number of products

        $this->assertEquals(1,1);
    }
}