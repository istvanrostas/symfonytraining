<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {

        $tag = $this->getDoctrine()->getRepository('ModelBundle:Tag')->findAll();

        return $this->render('AdminBundle:Admin:index.html.twig', array(
            'tags' => $tag,
        ));
    }

    /**
     * @Route("/{id}/edit")
     */
    public function editAction($id)
    {
        return $this->render('AdminBundle:Admin:edit.html.twig', array(

        ));
    }

}
