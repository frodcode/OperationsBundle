<?php

namespace Acme\OperationsBundle\Tests\Calculator\Operation;

use Acme\OperationsBundle\Calculator\Operation\PlusCalculator;

/**
 * @author odehnal@medio.cz
 */
class PlusCalculatorTest extends \PHPUnit_Framework_TestCase
{

	public function testCalculate()
	{
		$calculator = new PlusCalculator();
		$this->assertSame(8, $calculator->calculate(5, 3));
	}

}
