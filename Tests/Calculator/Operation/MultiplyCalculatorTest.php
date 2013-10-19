<?php

namespace Acme\OperationsBundle\Tests\Calculator\Operation;

use Acme\OperationsBundle\Calculator\Operation\MultiplyCalculator;

/**
 * @author odehnal@medio.cz
 */
class MultiplyCalculatorTest extends \PHPUnit_Framework_TestCase
{

	public function testCalculate()
	{
		$calculator = new MultiplyCalculator();
		$this->assertSame(15, $calculator->calculate(5, 3));
	}

}
