<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    /**
     * @Route("/signin")
     * @param Request $request
     */
    public function signinAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');


        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('CoreBundle:login:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     *Logout
     *
     * @Route("logout")
     */
    public function logoutAction()
    {

    }

}
