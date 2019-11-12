<?php 

namespace Drupal\Tests\mymodule\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\mymodule\MyClass;
use Drupal\mymodule\Order;

/**
 * Tests mymodule classes
 * @group mymodule
 */
class MyClassTest extends UnitTestCase {

	private $myclass;
	private $myorder;

	/**
	 * {@inheritdoc} 
	 */
	function setUp() {
		
		//MyClass object
		$this->myclass = new MyClass();

		// Order class object
		// Creating a mock PaymentGateway object for testing
		$gateway = $this->getMockBuilder('Drupal\mymodule\PaymentGateway')
										->setMethods(['charge'])
										->getMock();

		$gateway->method('charge')
						->willReturn(true);

		$this->myorder = new Order($gateway);

	}
		
	/**
	 * @covers Drupal\mymodule\MyClass::drupal7_to_drupal8
	 * assertEquals();
	 */
	function testMymodule_drupal7_to_drupal8_returns_drupal8() {
		
		$drupal_test = $this->myclass->drupal7_to_drupal8("Drupal 7");
		$this->assertEquals("Drupal 8", $drupal_test);

	}

	/**
	 * @covers Drupal\mymodule\MyClass::drupal7_to_drupal8
	 * assertNotEquals();
	 */
	function testMymodule_drupal7_to_drupal8_should_not_return_drupal8() {
		
		$drupal_test = $this->myclass->drupal7_to_drupal8("Drupal 7");
		$this->assertNotEquals("Drupal 9", $drupal_test);

	}

	/**
	 * @covers Drupal\mymodule\MyClass::my_array_range
	 * assertNotEmpty();
	 */
	function testMymodule_array_range_is_not_empty() {
		
		$arr_range = $this->myclass->my_array_range();
		$this->assertNotEmpty($arr_range);

	}
	
	/**
	 * @covers Drupal\mymodule\Order::process
	 */
	function testMymodule_order_mocking() {
		
		//set the order amount
		$this->myorder->amount = 200;

		//assert if the process ran or not
		$this->assertTrue($this->myorder->process());
	}

}

