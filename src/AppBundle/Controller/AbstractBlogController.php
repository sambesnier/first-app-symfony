<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 29/06/2017
 * Time: 14:13
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractBlogController extends Controller
{
    /**
     * Method that adds tags to parameters and return parent's render method
     *
     * @param string $view
     * @param array $parameters
     * @param Response|null $response
     * @return Response
     */
    public function render($view, array $parameters = array(), Response $response = null) {
        $parameters["tags"] = $this->getTags();

        $tag = null;
        if (array_key_exists("currentTag", $parameters)) {
            $tag = $parameters["currentTag"];
        }

        $parameters["lastPosts"] = $this->getLastArticles(3, $tag);

        return parent::render($view, $parameters, $response);
    }


    /**
     * Return an array of Tags
     *
     * @return array
     */
    private function getTags() {

        $repo = $this->getDoctrine()->getRepository("AppBundle:Tag");

        return $repo->getAllTagsWithPostsCount();
    }

    private function getLastArticles($number, $tag) {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Post');

        return $repo->getLastArticles($number, $tag);
    }
}