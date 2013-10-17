<?php

namespace Acme\OperationsBundle\Calculator\Parse;

/**
 * @author odehnal@medio.cz
 */
class ParseResult
{

	private $operationName;

	private $value;


	public function __construct($operationName, $value)
	{
		$this->operationName = $operationName;
		if (!is_numeric($value)) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException(sprintf('Given value "%s" is not a number.', $value));
		}
		$this->value = $value;
	}

	public function getOperationName()
	{
		return $this->operationName;
	}

	public function getValue()
	{
		return $this->value;
	}

}
