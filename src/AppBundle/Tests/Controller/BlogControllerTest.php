<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/blog/details/150');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
