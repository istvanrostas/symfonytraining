<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Entity\User;
use Blog\ModelBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    /**
     * @param Request $request
     * @Route("signup")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'You\'ve been successfully registrated');

            return $this->redirectToRoute('blog_core_post_index');
        }

        return $this->render(
            'CoreBundle::registration/reg.html.twig',
            array('form' => $form->createView())
        );
    }
}
