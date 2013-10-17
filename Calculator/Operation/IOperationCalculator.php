<?php

namespace Acme\OperationsBundle\Calculator\Operation;

/**
 * @author odehnal@medio.cz
 */
interface IOperationCalculator
{

	/**
	 * Tak initial value (oldValue), perform operation with doValue
	 * and return a result
	 *
	 * @param float $doValue
	 * @param float|NULL $oldValue
	 * @return float
	 */
	public function calculate($doValue, $oldValue);

}
