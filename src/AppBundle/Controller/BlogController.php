<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class BlogController
 * @package AppBundle\Controller
 * @Route("/blog")
 */
class BlogController extends AbstractBlogController
{
    /**
     * @Route(
     *     "/list",
     *     name="blog_list"
     * )
     */
    public function listAction()
    {
        return $this->render('AppBundle:Blog:list.html.twig', [

        ]);
    }

    /**
     * @Route(
     *     "/details",
     *     name="blog_details"
     * )
     */
    public function detailsAction()
    {
        return $this->render('AppBundle:Blog:details.html.twig', [

        ]);
    }

    /**
     * Posts list by tag
     * @Route(
     *     "/posts-by-tag/{tag}",
     *     name="posts_by_tag"
     * )
     * @param $tag
     */
    public function postsByTagAction($tag) {
        return $this->render('AppBundle:Blog:by-tag.html.twig', [
            "currentTag" => $tag
        ]);
    }
}
