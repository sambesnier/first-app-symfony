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

        $person = [
            "name" => "Besnier",
            "firstname" => "Samuel",
            "address" => [
                "path" => "16 clos Picasso",
                "zipcode" => "59310",
                "city" => "Orchies"
            ]
        ];

        $cave = [
            [
                "name" => "Poully fumé",
                "origin" => "Bourgogne",
                "cepage" => "Chardonay"
            ],
            [
                "name" => "Mouton Cadet",
                "origin" => "Bordeau",
                "cepage" => "Cabernet"
            ],
            [
                "name" => "Arbois Pupillin",
                "origin" => "Arbois",
                "cepage" => "Chardonay"
            ],
            [
                "name" => "Vin jaune",
                "origin" => "Arbois",
                "cepage" => "Savagnin"
            ],
            [
                "name" => "Nuit Saint Georges",
                "origin" => "Bourgogne",
                "cepage" => "Pinot noir"
            ]
        ];

        return $this->render('AppBundle:TwigPlayground:playground.html.twig', [
            "nom" => "Eli Lotar",
            "now" => new \DateTime(),
            "inventary" => $inventary,
            "client" => $person,
            "cave" => $cave
        ]);
    }

}
