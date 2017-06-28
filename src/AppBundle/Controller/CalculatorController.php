<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class CalculatorController
 * @package AppBundle\Controller
 * @Route(
 *     "/calc"
 * )
 */
class CalculatorController extends Controller
{
    /**
     * @Route(
     *     "/add/{n1}/{n2}",
     *     name="calc_add",
     *     requirements={
     *          "n1":"\d+",
     *          "n2":"\d+"
     *     }
     *
     * )
     * @param $n1
     * @param $n2
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction($n1, $n2)
    {
        return $this->render('AppBundle:Calculator:add.html.twig', array(
            "n1" => $n1,
            "n2" => $n2,
            "result" => $n1 + $n2
        ));
    }

    /**
     * @Route(
     *     "/substract/{n1}/{n2}",
     *     name="calc_sub",
     *     requirements={
     *          "n1":"\d+",
     *          "n2":"\d+"
     *     }
     * )
     * @param $n1
     * @param $n2
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function substractAction($n1, $n2)
    {
        return $this->render('AppBundle:Calculator:substract.html.twig', array(
            "n1" => $n1,
            "n2" => $n2,
            "result" => $n1 - $n2
        ));
    }

}
