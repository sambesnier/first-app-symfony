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
 *     "/posts"
 * )
 */
class DoctrinePlaygroundController extends Controller
{
    /**
     * @Route(
     *     "/insert-post",
     *     name="insert_post"
     * )
     */
    public function insertPostAction()
    {
        // Get all posts
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');

        // Get entity manager
        $em = $this->getDoctrine()->getManager();

        $title = "Symfony c'est super";

        // Search for post before create it
        $search = $repo->findOneByTitle($title);

        $post = new Post();

        if (! $search ) {
            // Post creation
            $post->setTitle($title);
            $post->setContent("Le texte de l'article");
            $post->setCreatedAt(new \DateTime());

            // Persist handling
            $em->persist($post);
        }

        // Delete post where id is 2
        $postToRemove = $repo->find(2);
        if ( $postToRemove ) {
            $em->remove($postToRemove);
        }

        // Change post title where id is 3
        $postToChangeTitle = $repo->find(3);
        if ( $postToChangeTitle ) {
            $postToChangeTitle->setTitle("Symfony 3 c'est encore mieux");
            $em->persist($postToChangeTitle);
        }

        // Finalize transaction
        $em->flush();

        $posts = $repo->findAll();

        return $this->render('AppBundle:DoctrinePlayground:insert_post.html.twig', [
            "post" => $post,
            "allPosts" => $posts
        ]);
    }

}
