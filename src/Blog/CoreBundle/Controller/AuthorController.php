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
     * Creates a new author entity.
     *
     * @param Request $request
     *
     * @Route("signup")
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function newAction(Request $request)
    {
        $author = new Author();
        $form = $this->createForm('Blog\ModelBundle\Form\AuthorType', $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($author);
            $em->flush($author);

            return $this->redirectToRoute('blog_core_author_show', array('id' => $author->getId()));
        }

        return $this->render('CoreBundle:Author:new.html.twig', array(
            'author' => $author,
            'form' => $form->createView(),
        ));
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
