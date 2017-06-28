<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TwigPlaygroundController extends Controller
{
    /**
     * @Route("/playground")
     */
    public function playgroundAction()
    {
        $inventary = [
            "un frigidaire",
            "un évier en fer",
            "un pistolet à gaufres"
        ];
        return $this->render('AppBundle:TwigPlayground:playground.html.twig', [
            "nom" => "Eli Lotar",
            "now" => new \DateTime(),
            "inventary" => $inventary
        ]);
    }

}
