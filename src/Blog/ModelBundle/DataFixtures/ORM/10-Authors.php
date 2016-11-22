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

        $plainPassword = 'david';
        $encoded = $encoder->encodePassword($a1, $plainPassword);
        $a1->setPassword($encoded);


        $a2 = new Author();
        $a2->setName('Eddie');

        $plainPassword = 'eddie';
        $encoded = $encoder->encodePassword($a2, $plainPassword);
        $a2->setPassword($encoded);


        $a3 = new Author();
        $a3->setName('Elsa');

        $plainPassword = 'elsa';
        $encoded = $encoder->encodePassword($a3, $plainPassword);
        $a3->setPassword($encoded);

        $a1->setRole('ROLE_ADMIN');
        $a2->setRole('ROLE_SUPER_ADMIN');
        $a3->setRole('ROLE_ADMIN');

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