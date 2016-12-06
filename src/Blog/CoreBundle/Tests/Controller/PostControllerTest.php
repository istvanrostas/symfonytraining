<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class PostControllerTest
 * @package Blog\CoreBundle\Tests\Controller
 */
class PostControllerTest extends WebTestCase
{
    /**
     * Test Post index
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not succesful.');
        $this->assertCount(4, $crawler->filter('h2'), 'There should be 3 displayed posts');
    }

    /**
     * Test Post show
     */
    public function testShow()
    {
        $client = static::createClient();

        /** @var Post $post */
        $post = $client->getContainer()
            ->get('Doctrine')
            ->getManager()->getRepository('ModelBundle:Post')
            ->findFirst();



        $crawler = $client->request('GET', '/en/posts/' . $post->getSlug());
        $this->assertTrue($client->getResponse()->isSuccessful(), "The response was not successfull.");

        $this->assertEquals($post->getTitle(), $crawler->filter('h1')->text());


    }

    public function testCreateComment()
    {
        
    }
}

