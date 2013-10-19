<?php

namespace Acme\OperationsBundle\Tests\Calculator\Parse;

use Acme\OperationsBundle\Calculator\Parse\ParseResult;

/**
 * @author odehnal@medio.cz
 */
class ParseResultTest extends \PHPUnit_Framework_TestCase
{

	public function testGets()
	{
		$result = new ParseResult('plus', 3);
		$this->assertSame('plus', $result->getOperationName());
		$this->assertSame(3, $result->getValue());
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage Given value "wrong" is not a number.
	 */
	public function testConstructorFailed()
	{
		new ParseResult('plus', 'wrong');
	}

}
