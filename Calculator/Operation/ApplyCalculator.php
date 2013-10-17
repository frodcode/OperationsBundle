<?php

namespace Acme\OperationsBundle\Calculator\Operation;

/**
 * @author odehnal@medio.cz
 */
class ApplyCalculator implements IOperationCalculator
{

	public function calculate($doValue, $oldValue)
	{
		if ($oldValue !== NULL) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException('Old value for apply calculator is supposed to be NULL - it should be the very first operation');
		}
		return $doValue;
	}

}
