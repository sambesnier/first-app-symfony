<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TwigPlaygroundController extends Controller
{
    /**
     * @Route(
     *     "/playground",
     *     name="playground"
     * )
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
                "cepage" => "Chardonay",
                "price" => 12
            ],
            [
                "name" => "Mouton Cadet",
                "origin" => "Bordeau",
                "cepage" => "Cabernet",
                "price" => 35
            ],
            [
                "name" => "Arbois Pupillin",
                "origin" => "Arbois",
                "cepage" => "Chardonay",
                "price" => 20
            ],
            [
                "name" => "Vin jaune",
                "origin" => "Arbois",
                "cepage" => "Savagnin",
                "price" => 28
            ],
            [
                "name" => "Nuit Saint Georges",
                "origin" => "Bourgogne",
                "cepage" => "Pinot noir",
                "price" => 25
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
