<?php

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures for the Author Entity
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
//        return 25;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();

        $comments = [
            0 => "Nunc eu egestas arcu, at dignissim turpis. Proin tempus euismod auctor.",
            1 => "Duis a mauris ac felis luctus sollicitudin a ut dolor. Maecenas id sem eu arcu
                  efficitur consequat quis in neque.",
            2 => "Donec volutpat venenatis magna ac pellentesque.",
        ];

        $i = 0;
        foreach ($posts as $post){
            $comment = new Comment();
            $comment->setAuthorName('Someone');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);

            $manager->persist($comment);
        }


        $manager->flush();

    }
}