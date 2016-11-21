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


        $usedTags = $this->getDoctrine()->getRepository('ModelBundle:Tag')->findUsedTags();


        return $this->render('CoreBundle:Tag:index.html.twig', array(
            'usedTags' => $usedTags,
        ));
    }

    /**
     * @Route("/tags/{name}/posts")
     */
    public function showAction($name)
    {
        /** @var Tag $tag */
        $tag = $this->getDoctrine()->getRepository('ModelBundle:Tag')->findOneBy(['name' => $name]);

        $posts = $tag->getPosts();

        return $this->render('CoreBundle:Tag:show.html.twig', array(
            'posts' => $posts,

        ));
    }

}
