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

	public function __construct(IParser $parser, OperationCalculatorRegister $operationCalculatorRegister)
	{
		$this->parser = $parser;
		$this->operationCalculatorRegister = $operationCalculatorRegister;
	}

	/**
	 * Parse and calculate result from input file
	 *
	 * @param mixed $file
	 * @return float
	 */
	public function calculate($file)
	{
		$parseResults = $this->parser->parse($file);

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
