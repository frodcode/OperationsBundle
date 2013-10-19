<?php

namespace Acme\OperationsBundle\Tests\Calculator;

use Acme\OperationsBundle\Calculator\Calculator;
use Acme\OperationsBundle\Calculator\Parse\ParseResult;

/**
 * @author odehnal@medio.cz
 */
class CalculatorTest extends \PHPUnit_Framework_TestCase
{

	public function testCalculate()
	{
		$parser = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Parse\IParser')->disableOriginalConstructor()->getMock();
		$operationCalculatorRegister = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\OperationCalculatorRegister')->disableOriginalConstructor()->getMock();
		$dataSourceHandler = $this->getMockBuilder('Acme\OperationsBundle\Calculator\DataSourceHandler')->disableOriginalConstructor()->getMock();

		$calculator = new Calculator($parser, $operationCalculatorRegister, $dataSourceHandler);

		$multiplyCalculator = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\MultiplyCalculator')->disableOriginalConstructor()->getMock();
		$applyCalculator = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\ApplyCalculator')->disableOriginalConstructor()->getMock();
		$addCalculator = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\PlusCalculator')->disableOriginalConstructor()->getMock();

		$name = '2';
		$content = "add 1\nmultiply 3\napply 3";
		$results = array(
			new ParseResult('apply', 3),
			new ParseResult('add', 1),
			new ParseResult('multiply', 4),
		);
		$dataSourceHandler->expects($this->once())
				->method('getContent')
				->with($this->equalTo($name))
				->will($this->returnValue($content));

		$parser->expects($this->once())
				->method('parse')
				->with($this->equalTo($content))
				->will($this->returnValue($results));

		$operationCalculatorRegister->expects($this->at(0))->method('getByKey')->with('apply')->will($this->returnValue($applyCalculator));
		$operationCalculatorRegister->expects($this->at(1))->method('getByKey')->with('add')->will($this->returnValue($addCalculator));
		$operationCalculatorRegister->expects($this->at(2))->method('getByKey')->with('multiply')->will($this->returnValue($multiplyCalculator));

		$applyCalculator->expects($this->once())->method('calculate')->with(3, NULL)->will($this->returnValue(3));
		$addCalculator->expects($this->once())->method('calculate')->with(1, 3)->will($this->returnValue(4));
		$multiplyCalculator->expects($this->once())->method('calculate')->with(4, 4)->will($this->returnValue(16));

		$result = $calculator->calculate($name);
		$this->assertSame(16, $result);
	}

	public function testIsSourceKnown()
	{
		$parser = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Parse\IParser')->disableOriginalConstructor()->getMock();
		$operationCalculatorRegister = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\OperationCalculatorRegister')->disableOriginalConstructor()->getMock();
		$dataSourceHandler = $this->getMockBuilder('Acme\OperationsBundle\Calculator\DataSourceHandler')->disableOriginalConstructor()->getMock();

		$calculator = new Calculator($parser, $operationCalculatorRegister, $dataSourceHandler);

		$name = 'test';
		$dataSourceHandler->expects($this->once())->method('dataSourceExists')->with($name)->will($this->returnValue(TRUE));
		$this->assertTrue($calculator->isSourceKnown($name));
	}

}
