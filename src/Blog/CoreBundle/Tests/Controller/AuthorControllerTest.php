<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AuthorControllerTest
 * @package Blog\CoreBundle\Tests\Controller
 */
class AuthorControllerTest extends WebTestCase
{

    /**
 * Test Post index
 */
    public function testShow()
    {
        $client = static::createClient();

        /** @var Author $author */
        $author = $client->getContainer()->get('doctrine')->getManager()
            ->getRepository('ModelBundle:Author')->findFirst();



        $crawler = $client->request('GET', '/author/' . $author->getSlug());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not succesful.');
//        $this->assertCount($authorPostCount, $crawler
//            ->filter('h2'), 'There should be '. $authorPostCount .' displayed posts');
    }

}
