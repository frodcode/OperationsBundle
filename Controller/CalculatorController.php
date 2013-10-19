<?php

namespace Acme\OperationsBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Acme\OperationsBundle\Calculator\Calculator;
use Acme\OperationsBundle\Calculator\DataSourceHandler;

class CalculatorController
{

	private $templating;

	private $calculator;

	private $dataSourceHandler;

    public function __construct(EngineInterface $templating, Calculator $calculator, DataSourceHandler $dataSourceHandler)
    {
        $this->templating = $templating;
		$this->calculator = $calculator;
		$this->dataSourceHandler = $dataSourceHandler;
    }

    public function indexAction($name)
    {
		if (!$this->dataSourceHandler->dataSourceExists($name)) {
			throw new NotFoundHttpException(sprintf('File source with name "%s" for calculation does not exist', $name));
		}
		$result = $this->calculator->calculate($name);
        return $this->templating->renderResponse('AcmeOperationsBundle:Calculator:index.html.twig', array('result' => $result));
    }
}
