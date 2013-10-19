<?php

namespace Acme\OperationsBundle\Tests\Calculator\Operation;

use Acme\OperationsBundle\Calculator\Operation\DivideCalculator;

/**
 * @author odehnal@medio.cz
 */
class DivideCalculatorTest extends \PHPUnit_Framework_TestCase
{

	private $divideCalcurator;

	public function setUp()
	{
		parent::setUp();
		$this->divideCalcurator = new DivideCalculator();
	}

	public function testCalculateOk()
	{
		$result = $this->divideCalcurator->calculate(2, 6);
		$this->assertSame(3, $result);
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage Cannot devide by zero. Please check input data.
	 */
	public function testCalculateFail()
	{
		$this->divideCalcurator->calculate(0, 4);
	}

}
