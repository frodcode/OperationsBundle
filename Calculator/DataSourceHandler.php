<?php

namespace Acme\OperationsBundle\Calculator;

/**
 * @author odehnal@medio.cz
 */
class DataSourceHandler
{

	private $sourceDir;

	public function __construct($sourceDir)
	{
		$this->sourceDir = rtrim($sourceDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
	}

	public function dataSourceExists($name)
	{
		return file_exists($this->getPathToSource($name));
	}

	private function getPathToSource($name)
	{
		return $this->sourceDir . $name;
	}

	public function getContent($name)
	{
		if (!$this->dataSourceExists($name)) {
			throw new Exception\IllegalArgumentException(sprintf('There is no data source with name "%s"', $name));
		}
		return file_get_contents($this->getPathToSource($name));
	}

}
