<?php

namespace Acme\OperationsBundle\Tests\Calculator\Operation;

use Acme\OperationsBundle\Calculator\Operation\OperationCalculatorRegister;

/**
 * @author odehnal@medio.cz
 */
class OperationCalculatorRegisterTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var \Acme\OperationsBundle\Calculator\Operation\OperationCalculatorRegister
	 */
	private $operationCalculatorRegister;

	private $plusCalculator;

	public function setUp()
	{
		parent::setUp();
		$this->plusCalculator = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\IOperationCalculator')->disableOriginalConstructor()->getMock();
		$calculators = array(
			'plus' => $this->plusCalculator,
			'minus' => $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\IOperationCalculator')->disableOriginalConstructor()->getMock(),
		);
		$this->operationCalculatorRegister = new OperationCalculatorRegister($calculators);
	}

	public function testGetByKey()
	{
		$calculator = $this->operationCalculatorRegister->getByKey('plus');
		$this->assertSame($this->plusCalculator, $calculator, 'Expected plus calculator, another given.');
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage There is no calculator with key "wrong".
	 */
	public function testGetByKeyFailDoesNotExist()
	{
		$this->operationCalculatorRegister->getByKey('wrong');
	}

	public function testAddOk()
	{
		$calculator = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\IOperationCalculator')->disableOriginalConstructor()->getMock();
		$this->operationCalculatorRegister->add($calculator, 'test');
		$this->assertSame($calculator, $this->operationCalculatorRegister->getByKey('test'));
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage There already is registered calculator with key "plus"
	 */
	public function testAddFailKeyAlreadyExists()
	{
		$calculator = $this->getMockBuilder('Acme\OperationsBundle\Calculator\Operation\IOperationCalculator')->disableOriginalConstructor()->getMock();
		$this->operationCalculatorRegister->add($calculator, 'plus');
	}

}
