<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AuthorController extends Controller
{
    /**
     * Get specified author
     *
     * @param $slug string
     *
     * @Route("/show/{slug}")
     */
    public function showAction($slug)
    {
        /** @var Author $author */
        $author = $this->getDoctrine()->getRepository('ModelBundle:Author')->findOneBy(['slug' => $slug]);

        if(is_null($author)){
            throw $this->createNotFoundException('This author is not found');
        }

        /**Ez miért nem mükszik??*/
//        $posts = $author->getPosts();

         $posts = $this->getDoctrine()->getRepository('ModelBundle:Post')->findBy(['author' => $author]);

        return $this->render('CoreBundle:Author:show.html.twig', [
            'author' => $author,
            'posts'  => $posts,
        ]);
    }

}
