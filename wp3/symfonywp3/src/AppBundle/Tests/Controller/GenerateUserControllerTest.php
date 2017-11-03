<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GenerateUserControllerTest extends WebTestCase
{
    public function testMakeusers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/makeUsers');
    }

}
