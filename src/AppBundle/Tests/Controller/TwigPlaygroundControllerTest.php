<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TwigPlaygroundControllerTest extends WebTestCase
{
    public function testPlayground()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/playground');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
