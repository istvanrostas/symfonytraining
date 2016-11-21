<?php

namespace Blog\ModelBundle\Repository;
use Doctrine\ORM\Query\AST\Join;
use Doctrine\ORM\Query\Expr;

/**
 * TagRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Find used tags
     *
     * @return array
     */
    public function findUsedTags()
    {
        $qb = $this->getQueryBuilder('ModelBundle:Tag', 't');
        return $qb->distinct()->innerJoin('t.posts', 'p')->getQuery()->getArrayResult();
    }


    public function findPostsToTag($tagName)
    {
        $qb = $this->getQueryBuilder('ModelBundle:Post', 'p');
        return $qb->innerJoin('p.tags', 't')
            ->where('t.name = :tagName')
            ->setParameter('tagName', $tagName)
            ->getQuery()
            ->getRes;
    }


    /**
     * @param string $model
     * @param string $alias
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getQueryBuilder($model, $alias)
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository($model)
            ->createQueryBuilder($alias);

        $em->flush();

        return $qb;
    }

}
