<?php

namespace Acme\OperationsBundle\Calculator;

/**
 * @author odehnal@medio.cz
 */
interface IDataSourceHandler
{

	public function dataSourceExists($name);

	public function getContent($name);

}
