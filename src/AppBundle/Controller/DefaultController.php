<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route(
     *     "/hello/{name}/{age}/{countryCode}",
     *     name="hello",
     *     defaults=
     *     {
     *          "name":"world",
     *          "age":"99",
     *          "countryCode":"fr"
     *     },
     *     requirements=
     *     {
     *          "age":"\d{1,3}",
     *          "countryCode":"fr|be|es"
     *     }
     * )
     * @param string $name
     * @param int $age
     * @param string $countryCode
     * @return Response
     */
    public function helloAction(string $name, int $age, string $countryCode) {
        $nationalities = [
            "fr" => "Française",
            "es" => "Espagnole",
            "be" => "Belge"
        ];

        $response = new Response("Hello $name vous avez $age ans et êtes de nationalité $nationalities[$countryCode]");

        return $response;
    }

    /**
     * @Route(
     *     "/login-admin",
     *     name="login_admin"
     * )
     */
    public function loginAdminAction() {

        return $this->render("AppBundle:Default:login-admin.html.twig", [


        ]);

    }
}
