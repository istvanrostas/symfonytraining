<?php

namespace Blog\CoreBundle\Controller;

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
        $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findAll();
        $latestPosts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findLatest(5);

        return $this->render('CoreBundle:Post:index.html.twig', array(
            'posts'        => $posts,
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
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')
            ->findOneBy([
               'slug' => $slug,
            ]);

        if( is_null($post) ){
            throw $this->createNotFoundException('Post was not found');
        }

        $form = $this->createForm(new CommentType());

        return $this->render('CoreBundle:Post:show.html.twig', [
           'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param string  $slug
     *
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     * @Template("CoreBundle:Post:show.html.twig")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $post = $this->getDoctrine()->getRepository('ModelBundle:Post')
            ->findOneBy([
                'slug' => $slug,
            ]);

        if( is_null($post) ){
            throw $this->createNotFoundException('Post was not found');
        }

        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->createForm(new CommentType(),$comment);
        $form->handleRequest($request);

        if($form->isValid()){
            $this->getDoctrine()->getManager()->persist($comment);
            $this->getDoctrine()->getManager()->flush();

            $this->get('session')->getFlashBag()->add('success','Your comment was submitted succesfully');

            return $this->redirect($this->generateUrl('blog_core_post_show', array('slug' => $post->getSlug())));
        }


        return $this->render('CoreBundle:Post:show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

}
