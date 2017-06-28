<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{

    public function testAddWithInvalidParameters()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc/add/invalid/invalid');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testAddWithValidParameters()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc/add/10/10');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc/add/10/10');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains("10 + 10 = 20", $crawler->text());
    }

    public function testSubstractWithInvalidParameters()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc/substract/invalid/invalid');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testSubstractWithValidArguments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc/substract/20/10');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testSubstract()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/calc/substract/20/10');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains("20 - 10 = 10", $crawler->text());
    }

}
