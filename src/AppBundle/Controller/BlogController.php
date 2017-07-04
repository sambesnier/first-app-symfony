<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\Tag;
use AppBundle\Form\PostType;
use AppBundle\Form\TagType;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $posts = $repo->getAllPosts();

        return $this->render('AppBundle:Blog:list.html.twig', [
            "posts" => $posts
        ]);
    }

    /**
     * @Route(
     *     "/last-posts/{number}",
     *     name="last_posts"
     * )
     *
     * @param $number
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function lastPostsAction($number) {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');

        $posts = $repo->getLastArticles($number);

        return $this->render('@App/Blog/list.html.twig', [
            "posts" => $posts
        ]);
    }

    /**
     * @Route(
     *     "/details/{id}",
     *     name="blog_details"
     * )
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailsAction(Post $post)
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Tag');

        $tags = $repo->getPostTags($post);

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

        // Get posts with query builder
        $repo = $this->getDoctrine()->getRepository("AppBundle:Post");

        $posts = $repo->getPostsByTag($tagName);

        return $this->render('@App/Blog/list.html.twig', [
            "currentTag" => $tagName,
            "posts" => $posts
        ]);
    }

    /**
     * Add a new tag
     * @Route(
     *     "/new-tag",
     *     name="new_tag"
     * )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newTag(Request $request) {

        $tag = new Tag();
        // Form creation with form factory
        $form = $this->createForm(
            TagType::class,
            $tag,
            [
                "method" => "post"
            ]
        );

        // Posted data Injection
        $form->handleRequest($request);

        // Only persist if form is submitted and validation tests are all ok
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Entity persistence
                $em = $this->getDoctrine()->getManager();
                $em->persist($tag);
                $em->flush();

                // Add flash message
                $this->addFlash('info', 'Votre tag a bien été ajouté');

                // Redirection to /new-tag route
                return $this->redirectToRoute('new_tag');
            } catch (UniqueConstraintViolationException $ex) {
                // Add flash message
                $this->addFlash('danger', 'Un tag portant ce nom existe déjà');
            }
        }

        return $this->render('AppBundle:Blog:new-tag.html.twig', [
            "formulaire" => $form->createView()
        ]);
    }

    /**
     * Add a new Post
     *
     * @Route(
     *     "/new-post",
     *     name="new_post"
     * )
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newPost(Request $request) {
        $post = new Post();

        $authorRepo = $this->getDoctrine()->getRepository("AppBundle:Author");
        $dumas = $authorRepo->findOneByName("Louis Dumas");

        $post->setAuthor($dumas);

        // Form creation with form factory
        $form = $this->createForm(
            PostType::class,
            $post,
            [
                "method" => "post"
            ]
        );

        // Posted data Injection
        $form->handleRequest($request);

        // Only persist if form is submitted and validation tests are all ok
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Entity persistence
                $em = $this->getDoctrine()->getManager();
                $em->persist($post);
                $em->flush();

                // Add flash message
                $this->addFlash('info', 'Votre article a bien été ajouté');

                // Redirection to /new-tag route
                return $this->redirectToRoute('new_post');
            } catch (UniqueConstraintViolationException $ex) {
                // Add flash message
                $this->addFlash('danger', 'Erreur d\'enregistrement');
            }
        }

        return $this->render('AppBundle:Blog:new-post.html.twig', [
            "formulaire" => $form->createView()
        ]);
    }
}
