<?php

namespace Acme\OperationsBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{

	private function getResultText($expectedNumber)
	{
		return sprintf('Result is: %d', $expectedNumber);
	}

	public function getDataSourceForTestCalculateSource()
	{
		return array(
			array(
				'source' => '1',
				'result' => 1
			),
			array(
				'source' => '2',
				'result' => 45
			),
			array(
				'source' => '3',
				'result' => 15
			),
		);
	}

	/**
	 * @dataProvider getDataSourceForTestCalculateSource
	 *
	 * @param string $source
	 * @param int $result
	 */
	public function testCalculateSource($source, $result)
	{
		$client = static::createClient();
		$crawler = $client->request('GET', '/operations/' . $source);
		$this->assertCount(1, $crawler->filter('html:contains("' . $this->getResultText($result) . '")'));
	}

	public function testCalculateNonExistingSource()
	{
		$client = static::createClient();
		$client->request('GET', '/operations/8');
		$this->assertTrue($client->getResponse()->isNotFound());
	}

}
