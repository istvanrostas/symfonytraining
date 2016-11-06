<?php
/**
 * Created by PhpStorm.
 * User: rosti
 * Date: 2016.11.06.
 * Time: 20:11
 */

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


/**
 * Fixtures for the Author Entity
 */
class Tags extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $t1 = new Tag();
        $t1->setName('entertainment');

        $t2 = new Tag();
        $t2->setName('sport');

        $t3 = new Tag();
        $t3->setName('music');

        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($t3);

        $manager->flush();

    }
}