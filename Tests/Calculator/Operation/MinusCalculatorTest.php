<?php

namespace Acme\OperationsBundle\Tests\Calculator\Operation;

use Acme\OperationsBundle\Calculator\Operation\MinusCalculator;

/**
 * @author odehnal@medio.cz
 */
class MinusCalculatorTest extends \PHPUnit_Framework_TestCase
{

	public function testCalculate()
	{
		$calculator = new MinusCalculator();
		$this->assertSame(2, $calculator->calculate(3, 5));
	}

}
