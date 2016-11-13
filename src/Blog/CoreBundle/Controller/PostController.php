<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/{slug}")
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

        return $this->render('CoreBundle:Post:show.html.twig', [
           'post' => $post,
        ]);
    }

}
