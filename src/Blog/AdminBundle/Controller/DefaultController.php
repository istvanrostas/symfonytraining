<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @param $name
     *
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirect($this->generateUrl('blog_admin_post_index'));
    }



}
