<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testHelloDefault()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains("Hello world vous avez 99 ans et êtes de nationalité Française", $crawler->text());
    }

    public function testHelloWithArguments()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Test/50/be');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains("Hello Test vous avez 50 ans et êtes de nationalité Belge", $crawler->text());
    }

    public function testHelloAgeRequirement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Test/5000');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }

    public function testHelloCountryCodeRequirement()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hello/Test/50/invalid');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
