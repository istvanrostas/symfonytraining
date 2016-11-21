<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Entity\Tag;
use Blog\ModelBundle\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TagController extends Controller
{
    /**
     * @Route("/tags")
     */
    public function indexAction()
    {
        /** @var TagRepository $tagRep */
        $tagRep = $this->getDoctrine()->getRepository('ModelBundle:Tag');


        return $this->render('CoreBundle:Tag:index.html.twig', array(
            'tags' => $tagRep->findUsedTags(),
        ));
    }

}
