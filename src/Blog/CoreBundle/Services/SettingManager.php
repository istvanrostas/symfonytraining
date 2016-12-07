<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.12.06.
 * Time: 8:15
 */

namespace Blog\CoreBundle\Services;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Setting;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


/**
 * Class AuthorManager
 */
class SettingManager
{
    /**
     * @var EntityManager em
     *
     */
    private $em;

    /**
     * AuthorManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function isCommentEnabled()
    {
      /** @var Setting $setting */
      $setting = $this->em->getRepository('ModelBundle:Setting')->findOneBy(['key' => 'enable_comment']);
      return $setting->getValue();
    }


}