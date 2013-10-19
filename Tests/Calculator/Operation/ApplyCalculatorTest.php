<?php

namespace Acme\OperationsBundle\Tests\Calculator\Operation;

use Acme\OperationsBundle\Calculator\Operation\ApplyCalculator;

/**
 * @author odehnal@medio.cz
 */
class ApplyCalculatorTest extends \PHPUnit_Framework_TestCase
{

	private $applyCalculator;

	public function setUp()
	{
		parent::setUp();
		$this->applyCalculator = new ApplyCalculator();
	}

	public function testCalculateOk()
	{
		$result = $this->applyCalculator->calculate(4, NULL);
		$this->assertSame(4, $result);
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage Old value for apply calculator is supposed to be NULL - it should be the very first operation
	 */
	public function testCalculateFail()
	{
		$this->applyCalculator->calculate(4, 1);
	}

}
