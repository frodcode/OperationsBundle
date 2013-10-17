<?php

namespace Acme\OperationsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Acme\OperationsBundle\Calculator\Calculator;

class CalculatorController
{

	private $templating;

	private $calculator;

    public function __construct(EngineInterface $templating, Calculator $calculator)
    {
        $this->templating = $templating;
		$this->calculator = $calculator;
    }

    public function indexAction($name)
    {
		$file = __DIR__ . '/../Resources/data/' . $name;
		$result = $this->calculator->calculate($file);
        return $this->templating->renderResponse('AcmeOperationsBundle:Calculator:index.html.twig', array('result' => $result));
    }
}
