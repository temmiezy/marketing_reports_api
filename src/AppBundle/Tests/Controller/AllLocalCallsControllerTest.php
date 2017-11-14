<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AllLocalCallsControllerTest extends WebTestCase
{
    public function testGetalllocalcalls()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/all_local_calls/graph/{year}/{month}');
    }

}
