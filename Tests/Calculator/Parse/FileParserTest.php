<?php

namespace Acme\OperationsBundle\Tests\Calculator\Parse;

use Acme\OperationsBundle\Calculator\Parse\FileParser;

/**
 * @author odehnal@medio.cz
 */
class FileParserTest extends \PHPUnit_Framework_TestCase
{

	private $parser;

	protected function setUp()
	{
		parent::setUp();
		$this->parser = new FileParser();
	}

	public function testParse1()
	{
		$content = "apply 10";
		$results = $this->parser->parse($content);

		$this->assertInternalType('array', $results);
		$this->assertCount(1, $results);
		$this->assertArrayHasKey(0, $results);

		$applyResult = $results[0];
		$this->assertSame('apply', $applyResult->getOperationName());
		$this->assertEquals(10, $applyResult->getValue());
	}

	public function testParse2()
	{
		$content = "multiply 3\napply 1";
		$results = $this->parser->parse($content);

		$this->assertInternalType('array', $results);
		$this->assertCount(2, $results);
		$this->assertArrayHasKey(0, $results);
		$this->assertArrayHasKey(1, $results);

		$applyResult = $results[0];
		$this->assertSame('apply', $applyResult->getOperationName());
		$this->assertEquals(1, $applyResult->getValue());

		$multiplyResult = $results[1];
		$this->assertSame('multiply', $multiplyResult->getOperationName());
		$this->assertEquals(3, $multiplyResult->getValue());
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage Cannot parse given content. Original message: Invalid row format. Expected format is <operation> <number>. "add" string given.
	 */
	public function testParseInvalidContent1()
	{
		$content = "multiply 3\nadd";
		$this->parser->parse($content);
	}

	/**
	 * @expectedException \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException
	 * @expectedExceptionMessage Cannot parse given content. Original message: Invalid row format. Expected format is <operation> <number>. "multiply" string given.
	 */
	public function testParseInvalidContent2()
	{
		$content = "multiply";
		$this->parser->parse($content);
	}

}
