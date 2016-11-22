<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.11.18.
 * Time: 14:20
 */

namespace ModelBundle\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TagRepositoryFunctionalTest extends  KernelTestCase{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager()
        ;
    }

    public function testFindAllUsedTag()
    {
        $usedTags = $this->em
            ->getRepository('ModelBundle:Tag')
            ->findAllUsedTags();

        $this->assertCount(1, $usedTags);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->em->close();
        $this->em = null; // avoid memory leaks
    }

}