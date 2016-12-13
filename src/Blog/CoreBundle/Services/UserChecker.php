<?php

namespace Blog\CoreBundle\Services;

use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016.12.13.
 * Time: 16:47
 */

class UserChecker {

    private $authorizationChecker;

    /**
     * UserChecker constructor.
     * @param $authorizationChecker
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function isUserLogged()
    {
        if(!$this->authorizationChecker->isGranted('IS_AUTHENTICATED_FULLY')){
            return false;
        }

        return true;
    }

}