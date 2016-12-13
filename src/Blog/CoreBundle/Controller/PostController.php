<?php

namespace Blog\CoreBundle\Controller;

use Blog\CoreBundle\Services\PostManager;
use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostController
 * @package Blog\CoreBundle\Controller
 */
class PostController extends Controller
{
    /**
     * Show posts index
     *
     * @Route("/")
     */
    public function indexAction()
    {
        $posts = $this->getPostManager()->findAll();
        $latestPosts = $this->getPostManager()->findLatest(5);

        return $this->render('CoreBundle:Post:index.html.twig', array(
            'posts' => $posts,
            'latestPosts' => $latestPosts,
        ));
    }

    /**
     * Show post
     *
     * @param $slug
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Route("/posts/{slug}")
     *
     */
    public function showAction($slug)
    {
        $post = $this->getPostManager()->findBySlug($slug);
        $form = $this->createForm(new CommentType());

        $enabled = $this->get('setting.manager')->isCommentEnabled();

        return $this->render('CoreBundle:Post:show.html.twig', [
            'enabled' => $enabled,
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param string $slug
     *
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     * @Template("CoreBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $this->get('app.user_checker')->isUserLoagged();
        $post = $this->getPostManager()->findBySlug($slug);
        $form = $this->getPostManager()->createComment($post, $request, $user);

        if (true === $form) {

            $this->get('session')->getFlashBag()->add('success', 'Your comment was submitted succesfully');

            return $this->redirect($this->generateUrl('blog_core_post_show', array('slug' => $post->getSlug())));
        }


        return $this->render('CoreBundle:Post:show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }


    /**
     * Get Post Manager
     *
     * @return PostManager
     */
    private function getPostManager()
    {
        return $this->get('post.manager');
    }



}
