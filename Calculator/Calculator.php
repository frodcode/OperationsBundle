<?php

namespace Acme\OperationsBundle\Calculator;

use Acme\OperationsBundle\Calculator\Operation\OperationCalculatorRegister;
use Acme\OperationsBundle\Calculator\Parse\IParser;
use Acme\OperationsBundle\Calculator\Parse\ParseResult;

/**
 * Calculator is a facade to calculation logic.
 *
 * @author odehnal@medio.cz
 */
class Calculator
{

	private $parser;

	private $operationCalculatorRegister;

	private $dataSourceHandler;

	public function __construct(IParser $parser, OperationCalculatorRegister $operationCalculatorRegister, IDataSourceHandler $dataSourceHandler)
	{
		$this->parser = $parser;
		$this->operationCalculatorRegister = $operationCalculatorRegister;
		$this->dataSourceHandler = $dataSourceHandler;
	}

	/**
	 * Parse and calculate result from input file
	 *
	 * @param mixed $sourceId
	 * @return float
	 */
	public function calculate($sourceId)
	{
		$content = $this->dataSourceHandler->getContent($sourceId);
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

	/**
	 * Check if the source exists in calculator source "database"
	 *
	 * @param mixed $sourceId
	 * @return bool
	 */
	public function isSourceKnown($sourceId)
	{
		return $this->dataSourceHandler->dataSourceExists($sourceId);
	}

}
