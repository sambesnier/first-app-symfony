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
     */
    public function render($view, array $parameters = array(), Response $response = null) {
        $parameters["tags"] = $this->getTags();

        return parent::render($view, $parameters, $response);
    }


    /**
     * Return an array of Tags
     *
     * @return array
     */
    private function getTags() {
        return [
            "Java",
            "PHP",
            "Ruby",
            "Python",
            "C++",
            "Go"
        ];
    }
}