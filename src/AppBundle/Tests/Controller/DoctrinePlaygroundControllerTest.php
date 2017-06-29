<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrinePlaygroundControllerTest extends WebTestCase
{
    public function testInsertpost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/insertPost');
    }

}
