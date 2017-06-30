<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
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
        $repo = $this->getDoctrine()->getRepository("AppBundle:Post");

        $posts = $repo->findAll();

        return $this->render('AppBundle:Blog:list.html.twig', [
            "posts" => $posts
        ]);
    }

    /**
     * @Route(
     *     "/details/{id}",
     *     name="blog_details"
     * )
     */
    public function detailsAction(Post $post)
    {
        $tags = $post->getTags();

        return $this->render('AppBundle:Blog:details.html.twig', [
            "post" => $post,
            "postTags" => $tags
        ]);
    }

    /**
     * Posts list by tag
     * @Route(
     *     "/posts-by-tag/{tagName}",
     *     name="posts_by_tag"
     * )
     * @param $tagName
     * @return \Symfony\Component\HttpFoundation\Response
     * @internal param $tag
     */
    public function postsByTagAction($tagName) {

        // Get posts with Tag object
        /*$repo = $this->getDoctrine()->getRepository("AppBundle:Tag");

        $tag = $repo->findOneBy(["tagName"=> $tagName]);

        $posts = $tag->getPosts();*/

        // Get posts with query builder
        $repo = $this->getDoctrine()->getRepository("AppBundle:Post");

        $query = $repo->createQueryBuilder('p')
            ->innerJoin('p.tags', 't', 'WITH', 't.tagName = :tagName')
            ->setParameter('tagName', $tagName)
            ->getQuery();

        $posts = $query->getResult();

        return $this->render('AppBundle:Blog:by-tag.html.twig', [
            "currentTag" => $tagName,
            "posts" => $posts
        ]);
    }
}
