<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorController extends Controller
{
    /**
     * @Route(
     *     "/author",
     *     name="author_index")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Author:index.html.twig', array(

        ));
    }

}
