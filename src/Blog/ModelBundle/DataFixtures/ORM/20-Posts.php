<?php
/**
 * Created by PhpStorm.
 * User: rosti
 * Date: 2016.11.06.
 * Time: 19:09
 */

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures for the Post Entity
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
        $p1->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Aliquam erat volutpat. Quisque eleifend dictum risus, in condimentum 
         leo iaculis et. Sed eu felis a dolor lobortis cursus a ut ipsum.
          Mauris pulvinar risus ante, eget congue tortor feugiat eu. Phasellus vitae cursus
           urna. Etiam ante libero, finibus nec velit eu, pellentesque ornare libero.
            Nullam vitae mattis massa, in blandit mauris.');
        $p1->setAuthor($this->getAuthor($manager, 'David'));
        $p1->addTag($this->getTag($manager, 'entertainment'));


        $p2 = new Post();
        $p2->setTitle('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
        $p2->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Aliquam erat volutpat. Quisque eleifend dictum risus, in condimentum 
         leo iaculis et. Sed eu felis a dolor lobortis cursus a ut ipsum.
          Mauris pulvinar risus ante, eget congue tortor feugiat eu. Phasellus vitae cursus
           urna. Etiam ante libero, finibus nec velit eu, pellentesque ornare libero.
            Nullam vitae mattis massa, in blandit mauris.');
        $p2->setAuthor($this->getAuthor($manager, 'Eddie'));
        $p2->addTag($this->getTag($manager, 'sport'));


        $p3 = new Post();
        $p3->setTitle('Lorem ipsum dolor sit amet, consectetur adipiscing elit.');
        $p3->setBody('Lorem ipsum dolor sit amet, consectetur adipiscing elit.
         Aliquam erat volutpat. Quisque eleifend dictum risus, in condimentum 
         leo iaculis et. Sed eu felis a dolor lobortis cursus a ut ipsum.
          Mauris pulvinar risus ante, eget congue tortor feugiat eu. Phasellus vitae cursus
           urna. Etiam ante libero, finibus nec velit eu, pellentesque ornare libero.
            Nullam vitae mattis massa, in blandit mauris.');
        $p3->setAuthor($this->getAuthor($manager, 'Elsa'));
        $p3->addTag($this->getTag($manager, 'sport'));



        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();

    }


    /**
     * Get an author
     *
     * @param ObjectManager $manager
     * @param string $name
     *
     * @return Author
     */
    private function getAuthor(ObjectManager $manager, $name)
    {
        return $manager->getRepository('ModelBundle:Author')->findOneBy(['name' => $name]);
    }

    private function getTag(ObjectManager $manager, $name)
    {
        return $manager->getRepository('ModelBundle:Tag')->findOneBy(['name' => $name]);
    }

}