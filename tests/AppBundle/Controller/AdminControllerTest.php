<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase {
    public function _indexReturnsStatus200AndTitle() {
        $client = static::createClient();
        $crawler = $client->request('GET', '/admin');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Herner Eissportverein - Leinwand', $crawler->filter('title')->text());
    }
}
