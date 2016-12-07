<?php

namespace Blog\CoreBundle\Controller;

use Blog\CoreBundle\Services\AuthorManager;
use Blog\ModelBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorController extends Controller
{
    /**
     * Get specified author
     *
     * @param $slug string
     *
     * @Route("/author/{slug}")
     */
    public function showAction($slug)
    {
        /** @var Author $author */
        $author = $this->getAuthorManager()->findBySlug($slug);
        $posts = $this->getAuthorManager()->findPosts($author);

        return $this->render('CoreBundle:Author:show.html.twig', [
            'author' => $author,
            'posts' => $posts,
        ]);
    }



    /**
     * Get Author Manager
     *
     * @return AuthorManager
     */
    private function getAuthorManager()
    {
        return $this->get('author.manager');
    }

}
