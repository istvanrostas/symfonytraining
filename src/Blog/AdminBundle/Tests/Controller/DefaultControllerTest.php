<?php

namespace Blog\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient([
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ]);

        $crawler = $client->request('GET', '/admin');

        $this->assertTrue(
            $client->getResponse()->isRedirect('/admin/post'),
            'There was no redirection to the posts index.'
        );
    }

}