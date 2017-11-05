<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WerkbeheerderControllerTest extends WebTestCase
{
    public function testToekennentechnicus()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/toekennenTechnicus');
    }

}
