<?php

namespace Acme\OperationsBundle\Calculator;

use Acme\OperationsBundle\Calculator\Operation\OperationCalculatorRegister;
use Acme\OperationsBundle\Calculator\Parse\IParser;
use Acme\OperationsBundle\Calculator\Parse\ParseResult;

/**
 * @author odehnal@medio.cz
 */
class Calculator
{

	private $parser;

	private $operationCalculatorRegister;

	private $dataSourceHandler;

	public function __construct(IParser $parser, OperationCalculatorRegister $operationCalculatorRegister, DataSourceHandler $dataSourceHandler)
	{
		$this->parser = $parser;
		$this->operationCalculatorRegister = $operationCalculatorRegister;
		$this->dataSourceHandler = $dataSourceHandler;
	}

	/**
	 * Parse and calculate result from input file
	 *
	 * @param mixed $source
	 * @return float
	 */
	public function calculate($source)
	{
		$content = $this->dataSourceHandler->getContent($source);
		$parseResults = $this->parser->parse($content);

		// initial value for chain of responsibility for calculation
		$calculatedValue = NULL;
		foreach ($parseResults as $parseResult) {
			$operationCalculator = $this->findOperationCalculatorFor($parseResult);
			$calculatedValue = $operationCalculator->calculate($parseResult->getValue(), $calculatedValue);
		}
		return $calculatedValue;
	}

	private function findOperationCalculatorFor(ParseResult $parseResult)
	{
		return $this->operationCalculatorRegister->getByKey($parseResult->getOperationName());
	}

}
