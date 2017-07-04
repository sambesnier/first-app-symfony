<?php

/**
 * Created by PhpStorm.
 * User: Samuel Besnier
 * Date: 30/06/2017
 * Time: 13:48
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthorFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        $encoder = $this->container->get('security.password_encoder');

        for ($i = 0; $i < 10; $i++)
        {
            $author = new Author();
            $author->setName($faker->firstNameMale. " " .$faker->lastName);
            $author->setEmail($faker->email);
            $author->setGender("M");
            $author->setBirthDate($faker->dateTimeThisCentury);

            $password = $encoder->encodePassword($author, "1234");
            $author->setPassword($password);

            $manager->persist($author);
            $this->setReference("author_".$i, $author);
        }

        for ($i = 0; $i < 10; $i++)
        {
            $author = new Author();
            $author->setName($faker->firstNameFemale. " " .$faker->lastName);
            $author->setEmail($faker->email);
            $author->setGender("F");
            $author->setBirthDate($faker->dateTimeThisCentury);

            $password = $encoder->encodePassword($author, "1234");
            $author->setPassword($password);

            $manager->persist($author);
            $this->setReference("author_".($i+10), $author);
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
        return 1;
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}