<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.12.06.
 * Time: 8:15
 */

namespace Blog\CoreBundle\Services;

use Blog\ModelBundle\Entity\Author;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class AuthorManager
 */
class AuthorManager
{
    /**
     * @var EntityManager em
     *
     */
    private $em;

    /**
     * AuthorManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    /**
     * Find an author by slug
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return Author
     */
    public function findBySlug($slug)
    {
        $author = $this->em->getRepository('ModelBundle:Author')->findOneBy([
            'slug' => $slug,
        ]);

        if (null === $author) {
            throw new NotFoundHttpException('Author was not found.');
        }

        return $author;
    }


    /**
     * Find all posts for a given author
     *
     * @param Author $author
     * @return array
     */
    public function findPosts(Author $author)
    {
        $posts = $this->em->getRepository('ModelBundle:Post')->findBy([
            'author' => $author,
        ]);

        return $posts;
    }


}