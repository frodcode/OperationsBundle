<?php

namespace Acme\OperationsBundle\Calculator\Parse;

/**
 * @author odehnal@medio.cz
 */
class FileParser implements IParser
{

	private function getRowsFromContent($content)
	{
		$rows = explode("\n", $content);
		$realOrderRows = array();
		$realOrderRows[] = $rows[count($rows) - 1];
		unset($rows[count($rows) - 1]);
		foreach ($rows as $row) {
			$realOrderRows[] = $row;
		}
		return $realOrderRows;
	}

	public function parse($content)
	{
		try {
			$rows = $this->getRowsFromContent($content);
			$results = array();

			foreach ($rows as $row) {
				$results[] = $this->createParseResult($row);
			}
		} catch (\Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException $e) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException('Cannot parse given content. Original message: ' . $e->getMessage(), NULL, $e);
		}
		return $results;
	}

	private function createParseResult($row)
	{
		$parts = explode(' ', $row);
		if (count($parts) !== 2) {
			throw new \Acme\OperationsBundle\Calculator\Exception\IllegalArgumentException(sprintf('Invalid row format. Expected format is <operation> <number>. "%s" string given.', $row));
		}
		return new ParseResult($parts[0], (float) $parts[1]);
	}

}
