<?php

namespace Acme\OperationsBundle\Calculator\Operation;

/**
 * @author odehnal@medio.cz
 */
class MinusCalculator implements IOperationCalculator
{

	public function calculate($doValue, $oldValue)
	{
		return $oldValue - $doValue;
	}

}
