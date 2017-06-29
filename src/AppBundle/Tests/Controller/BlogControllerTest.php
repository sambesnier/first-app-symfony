<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BlogControllerTest extends WebTestCase
{
    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/list');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/details');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
