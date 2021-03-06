<?php
/**
 * Created by PhpStorm.
 * User: rosti
 * Date: 2016.11.06.
 * Time: 18:59
 */

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Fixtures for the Author Entity
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{

    private $container;

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

        $encoder = $this->container->get('security.password_encoder');

        $a1 = new Author();
        $a1->setName('David');


        $a2 = new Author();
        $a2->setName('Eddie');


        $a3 = new Author();
        $a3->setName('Elsa');

        $a1->setPassword($encoder->encodePassword($a1, 'admin'));
        $a2->setPassword($encoder->encodePassword($a2, 'admin'));
        $a3->setPassword($encoder->encodePassword($a3, 'admin'));


        $a1->setRole('ROLE_SUPER_ADMIN');
        $a2->setRole('ROLE_ADMIN');
        $a3->setRole('ROLE_ADMIN');

        $a1->setEmail('asd1@gmail.com');
        $a2->setEmail('asd2@gmail.com');
        $a3->setEmail('asd3@gmail.com');

        $a1->setIsActive('1');
        $a2->setIsActive('1');
        $a3->setIsActive('1');


        $manager->persist($a1);
        $manager->persist($a2);
        $manager->persist($a3);

        $manager->flush();

    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}