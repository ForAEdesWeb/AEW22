<?php
/**
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Joomla\Input\Tests;

use Joomla\Input\Input;
use Joomla\Input\Cookie;
use Joomla\Test\TestHelper;

require_once __DIR__ . '/Stubs/FilterInputMock.php';

/**
 * Test class for Input.
 *
 * @since  1.0
 */
class InputTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * The test class.
	 *
	 * @var    Input
	 * @since  1.0
	 */
	private $instance;

	/**
	 * The mock filter object
	 *
	 * @var    FilterInputMock
	 * @since  1.0
	 */
	private $filterMock;

	/**
	 * Test the Joomla\Input\Input::__construct method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::__construct
	 * @since   1.0
	 */
	public function test__construct()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Test the Joomla\Input\Input::__call method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::__call
	 * @since   1.0
	 */
	public function test__call()
	{
		$this->markTestIncomplete();
	}

	/**
	 * Test the Joomla\Input\Input::__get method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::__get
	 * @since   1.0
	 */
	public function test__get()
	{
		$instance = $this->getInputObject(array());

		$this->assertAttributeEquals($_GET, 'data', $instance->get);
	}

	/**
	 * Test the Joomla\Input\Input::count method with no data.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::count
	 * @since   1.0
	 */
	public function testCountWithNoData()
	{
		$instance = $this->getInputObject(array());

		$this->assertEquals(
			0,
			$instance->count()
		);
	}

	/**
	 * Test the Joomla\Input\Input::count method with data.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::count
	 * @since   1.0
	 */
	public function testCountWithData()
	{
		$instance = $this->getInputObject(array('foo' => 2, 'bar' => 3, 'gamma' => 4));

		$this->assertEquals(
			3,
			$instance->count()
		);
	}

	/**
	 * Test the Joomla\Input\Input::get method with a normal value.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetWithStandardValue()
	{
		$instance = $this->getInputObject(array('foo' => 'bar'));

		$this->assertEquals(
			'bar',
			$instance->get('foo')
		);
	}

	/**
	 * Test the Joomla\Input\Input::get method with empty string.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetWithEmptyString()
	{
		$instance = $this->getInputObject(array('foo' => ''));

		$this->assertEquals(
			'',
			$instance->get('foo')
		);

		$this->assertInternalType('string', $instance->get('foo'));
	}

	/**
	 * Test the Joomla\Input\Input::get method with integer 0.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetWith0()
	{
		$instance = $this->getInputObject(array('foo' => 0));

		$this->assertEquals(
			0,
			$instance->getInt('foo')
		);

		$this->assertInternalType('integer', $instance->get('foo'));
	}

	/**
	 * Test the Joomla\Input\Input::get method with float 0.0.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetWith0Point0()
	{
		$instance = $this->getInputObject(array('foo' => 0.0));

		$this->assertEquals(
			0.0,
			$instance->getFloat('foo')
		);

		$this->assertInternalType('float', $instance->get('foo'));
	}

	/**
	 * Test the Joomla\Input\Input::get method with string "0".
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetWithString0()
	{
		$instance = $this->getInputObject(array('foo' => "0"));

		$this->assertEquals(
			"0",
			$instance->get('foo')
		);

		$this->assertInternalType('string', $instance->get('foo'));
	}

	/**
	 * Test the Joomla\Input\Input::get method with false.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetWithFalse()
	{
		$instance = $this->getInputObject(array('foo' => false));

		$this->assertEquals(
			false,
			$instance->getBoolean('foo')
		);

		$this->assertInternalType('boolean', $instance->get('foo'));
	}

	/**
	 * Tests retrieving a default value..
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetDefault()
	{
		$instance = $this->getInputObject(array('foo' => 'bar'));

		// Test the get method.
		$this->assertEquals('default', $instance->get('default_value', 'default'));
	}

	/**
	 * Test the Joomla\Input\Input::def method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::def
	 * @since   1.0
	 */
	public function testDefNotReadWhenValueExists()
	{
		$instance = $this->getInputObject(array('foo' => 'bar'));

		$instance->def('foo', 'nope');

		$this->assertEquals('bar', $instance->get('foo'));
	}

	/**
	 * Test the Joomla\Input\Input::def method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::def
	 * @since   1.0
	 */
	public function testDefRead()
	{
		$instance = $this->getInputObject(array('foo' => 'bar'));

		$instance->def('bar', 'nope');

		$this->assertEquals('nope', $instance->get('bar'));
	}

	/**
	 * Test the Joomla\Input\Input::set method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::set
	 * @since   1.0
	 */
	public function testSet()
	{
		$instance = $this->getInputObject(array('foo' => 'bar'));

		$instance->set('foo', 'gamma');

		$this->assertEquals('gamma', $instance->get('foo'));
	}

	/**
	 * Test the Joomla\Input\Input::getArray method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetArray()
	{
		$array = array(
			'var1' => 'value1',
			'var2' => 34,
			'var3' => array('test')
		);

		$input = $this->getInputObject($array);

		$this->assertEquals($array, $input->getArray(
			array('var1' => 'filter1', 'var2' => 'filter2', 'var3' => 'filter3')
		));

		$this->assertEquals(array('value1', 'filter1'), $this->filterMock->calls['clean'][0]);
		$this->assertEquals(array(34, 'filter2'), $this->filterMock->calls['clean'][1]);
		$this->assertEquals(array(array('test'), 'filter3'), $this->filterMock->calls['clean'][2]);
	}

	/**
	 * Test the Joomla\Input\Input::get method using a nested data set.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetArrayNested()
	{
		$array = array(
			'var2' => 34,
			'var3' => array('var2' => 'test'),
			'var4' => array('var1' => array('var2' => 'test'))
		);

		$input = $this->getInputObject($array);

		$this->assertEquals(
			array('var4' => array('var1' => array('var2' => 'test'))),
			$input->getArray(
				array(
					'var4' => array(
						'var1' => array('var2' => 'test')
					)
				)
			)
		);
	}

	/**
	 * Test the Joomla\Input\Input::getArray method without specified variables.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::getArray
	 * @since   1.0
	 */
	public function testGetArrayWithoutSpecifiedVariables()
	{
		$array = array(
			'var2' => 34,
			'var3' => array('var2' => 'test'),
			'var4' => array('var1' => array('var2' => 'test')),
			'var5' => array('foo' => array()),
			'var6' => array('bar' => null),
			'var7' => null
		);

		$input = $this->getInputObject($array);

		$this->assertEquals($input->getArray(), $array);
	}

	/**
	 * Test the Joomla\Input\Input::get method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::get
	 * @since   1.0
	 */
	public function testGetFromCookie()
	{
		$instance = $this->getInputObject(array());

		$_COOKIE['foo'] = 'bar';

		$this->assertAttributeEquals($_COOKIE, 'data', $instance->cookie);
	}

	/**
	 * Test the Joomla\Input\Input::getMethod method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::getMethod
	 * @since   1.0
	 */
	public function testGetMethod()
	{
		$_SERVER['REQUEST_METHOD'] = 'custom';

		$instance = $this->getInputObject(array());

		$this->assertEquals('CUSTOM', $instance->getMethod());
	}

	/**
	 * Test the Joomla\Input\Input::serialize method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::serialize
	 * @since   1.0
	 */
	public function testSerialize()
	{
		$instance = $this->getInputObject(array());

		// Load the inputs so that the static $loaded is set to true.
		TestHelper::invoke($instance, 'loadAllInputs');

		// Adjust the values so they are easier to handle.
		TestHelper::setValue($instance, 'inputs', array('server' => 'remove', 'env' => 'remove', 'request' => 'keep'));
		TestHelper::setValue($instance, 'options', 'options');
		TestHelper::setValue($instance, 'data', 'data');

		$this->assertThat(
			$instance->serialize(),
			$this->equalTo('a:3:{i:0;s:7:"options";i:1;s:4:"data";i:2;a:1:{s:7:"request";s:4:"keep";}}')
		);
	}

	/**
	 * Test the Joomla\Input\Input::unserialize method.
	 *
	 * @return  void
	 *
	 * @covers  Joomla\Input\Input::unserialize
	 * @since   1.0
	 */
	public function testUnserialize()
	{
		$serialized = 'a:3:{i:0;s:7:"options";i:1;s:4:"data";i:2;a:1:{s:7:"request";s:4:"keep";}}';

		$instance = $this->getInputObject(array());

		$instance->unserialize($serialized);

		$this->assertAttributeEquals('data', 'data', $instance);
	}

	/**
	 * Get Input object populated with passed in data
	 *
	 * @return  Input
	 *
	 * @since   1.0
	 */
	protected function getInputObject($data)
	{
		return new Input($data, array('filter' => $this->filterMock));
	}

	/**
	 * Setup for testing.
	 *
	 * @return  void
	 *
	 * @since   1.0
	 */
	protected function setUp()
	{
		parent::setUp();

		$this->filterMock = new FilterInputMock;
	}
}