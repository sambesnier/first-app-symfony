<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class BlogController
 * @package AppBundle\Controller
 * @Route("/blog")
 */
class BlogController extends Controller
{
    /**
     * @Route(
     *     "/list",
     *     name="blog_list"
     * )
     */
    public function listAction()
    {
        return $this->render('AppBundle:Blog:list.html.twig', array(

        ));
    }

    /**
     * @Route(
     *     "/details",
     *     name="blog_details"
     * )
     */
    public function detailsAction()
    {
        return $this->render('AppBundle:Blog:details.html.twig', array(

        ));
    }

}
