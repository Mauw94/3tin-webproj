<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TechnicusControllerTest extends WebTestCase
{
    public function testToegekendeproblemen()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/toegekendeProblemen');
    }

}
