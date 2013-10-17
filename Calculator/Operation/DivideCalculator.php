<?php

namespace Acme\OperationsBundle\Calculator\Operation;

/**
 * @author odehnal@medio.cz
 */
class DivideCalculator implements IOperationCalculator
{

	public function calculate($doValue, $oldValue)
	{
		if ($doValue === 0) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException('Cannot devide by zero. Please check input data.');
		}
		return $oldValue / $doValue;
	}

}
