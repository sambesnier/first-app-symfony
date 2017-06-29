<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DoctrinePlaygroundController
 * @package AppBundle\Controller
 *
 * @Route(
 *     "/posts/"
 * )
 */
class DoctrinePlaygroundController extends Controller
{
    /**
     * @Route(
     *     "/insert-post"
     *     name="insert_post"
     * )
     */
    public function insertPostAction()
    {
        // Post creation
        $post = new Post();
        $post->setTitle("Symfony c'est super");
        $post->setContent("Le texte de l'article");
        $post->setCreatedAt(new \DateTime());

        // Get entity manager
        $em = $this->getDoctrine()->getManager();

        // Persist handling
        $em->persist($post);

        // Finalize transaction
        $em->flush();

        return $this->render('AppBundle:DoctrinePlayground:insert_post.html.twig', array(

        ));
    }

}
