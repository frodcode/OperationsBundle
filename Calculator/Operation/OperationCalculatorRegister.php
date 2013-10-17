<?php

namespace Acme\OperationsBundle\Calculator\Operation;

/**
 * Register for calculators. See DI configuration.
 *
 * @author odehnal@medio.cz
 */
class OperationCalculatorRegister
{

	private $calculators;

	public function __construct(array $calculators)
	{
		$this->calculators = array();
		foreach ($calculators as $key => $calculator) {
			$this->add($calculator, $key);
		}
	}

	public function add(IOperationCalculator $calculator, $key)
	{
		if ($this->hasCalculatorWithKey($key)) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException(sprintf('There already is registered calculator with key "%s".', $key));
		}
		$this->calculators[$key] = $calculator;
	}

	private function hasCalculatorWithKey($key)
	{
		return array_key_exists($key, $this->calculators);
	}

	public function getByKey($key)
	{
		if (!$this->hasCalculatorWithKey($key)) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException(sprintf('There is no calculator with key "%s".', $key));
		}
		return $this->calculators[$key];
	}

}
