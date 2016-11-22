<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    /**
     * @Route("/login")
     */
    public function loginAction()
    {
//        $request = $this->getRequest();
//        $session = $request->getSession();
//
//        if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)){
//            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
//        }else{
//            $error = $request->get(SecurityContext::AUTHENTICATION_ERROR);
//            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
//        }
//
//        return $this->render(
//            'AdminBundle:Security:login.html.twig',
//            [
//                'last_username'  => $session->get(SecurityContext::LAST_USERNAME),
//                'error'          => $error,
//            ]
//        );



        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('AdminBundle:Security:login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));

    }

    /**
     * Login check
     *
     * @Route("login_check")
     */
    public function loginCheckAction()
    {

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

