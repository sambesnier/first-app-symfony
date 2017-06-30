<?php
/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 30/06/2017
 * Time: 14:18
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++)
        {
            $post = new Post();
            $post->setAuthor($this->getReference("author_".$i))
                ->setTitle($faker->realText(80))
                ->setContent($faker->realText(500))
                ->addTag($this->getReference("tag_php"))
                ->addTag($this->getReference("tag_prog"));

            $manager->persist($post);

            $post = new Post();
            $post->setAuthor($this->getReference("author_".$i))
                ->setTitle($faker->realText(80))
                ->setContent($faker->realText(500))
                ->addTag($this->getReference("tag_prog"))
                ->addTag($this->getReference("tag_angular"));

            $manager->persist($post);
        }
        for ($i = 0; $i < 10; $i++)
        {
            $post = new Post();
            $post->setAuthor($this->getReference("author_".($i+10)))
                ->setTitle($faker->realText(80))
                ->setContent($faker->realText(500))
                ->addTag($this->getReference("tag_linux"));

            $manager->persist($post);

            $post = new Post();
            $post->setAuthor($this->getReference("author_".($i+10)))
                ->setTitle($faker->realText(80))
                ->setContent($faker->realText(500))
                ->addTag($this->getReference("tag_prog"))
                ->addTag($this->getReference("tag_javascript"))
                ->addTag($this->getReference("tag_php"));

            $manager->persist($post);
        }

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}