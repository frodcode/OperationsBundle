<?php

namespace Acme\OperationsBundle\Calculator\Parse;

/**
 * @author odehnal@medio.cz
 */
interface IParser
{

	/**
	 * @param mixed $what
	 * @return \Acme\OperationsBundle\Calculator\Parse\ParseResult[]
	 */
	public function parse($what);

}
