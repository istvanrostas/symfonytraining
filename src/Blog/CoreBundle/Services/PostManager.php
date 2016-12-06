<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.12.06.
 * Time: 9:47
 */

namespace Blog\CoreBundle\Services;

use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Form\CommentType;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostManager
 */
class PostManager
{
    /**
     * @var EntityManager $em
     */
    private $em;

    /**
     * @var FactoryInterface
     */
    private $formFactory;

    /**
     * PostManager constructor.
     * @param EntityManager $em
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManager $em, FormFactoryInterface $formFactory)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
    }


    /**
     * Find all posts
     *
     * @return array
     */
    public function findAll()
    {
        return $this->em->getRepository('ModelBundle:Post')->findAll();
    }

    /**
     * Find latest posts
     *
     * @param $num int
     *
     * @return mixed
     */
    public function findLatest($num)
    {
        return $this->em->getRepository('ModelBundle:Post')->findLatest($num);
    }


    /**
     * Find post by slug
     *
     * @param string $slug
     * @return Post
     */
    public function findBySlug($slug)
    {
        $post = $this->em->getRepository('ModelBundle:Post')->findOneBy([
            'slug' => $slug
        ]);

        if (null === $post) {
            throw new NotFoundHttpException('Post was not founded');
        }

        return $post;
    }

    /**
     * Create and validate a new comment
     *
     * @param Post    $post
     * @param Request $request
     * @return FormInterface|boolean
     */
    public function createComment(Post $post, Request $request)
    {

        $comment = new Comment();
        $comment->setPost($post);

        /** @var FormInterface $form */
        $form = $this->formFactory->create(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->em->persist($comment);
            $this->em->flush();

            return true;
        }

        return $form;
    }


}