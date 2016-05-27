<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 01/05/16
 * Time: 12:47
 */

namespace Starcode\Library\Auth;

use Phalcon\Acl;
use Phalcon\Annotations\Annotation;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

class Security extends Plugin
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event      $event
     * @param Dispatcher $dispatcher
     *
     * @return bool
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        //TODO: putanje iz configa isčitati u initu!

//        $auth                = $this->session->get(Auth::AUTH_KEY);
        $auth                = $this->auth->getCurrentUser();
        $controllerClass     = $this->dispatcher->getControllerClass();
        $action              = $dispatcher->getActionName() . "Action";
        $methodHasAnnotation = $this->annotations->getMethod($controllerClass, $action)->has(AccessAnnotation::NAME);
        $classHasAnnotation  = FALSE;

        if ($this->annotations->get($controllerClass)->getClassAnnotations()) {
            foreach ($this->annotations->get($controllerClass)->getClassAnnotations() as $classAnnotation) {
                if ($classAnnotation->getName() == AccessAnnotation::NAME) {
                    $classHasAnnotation = TRUE;
                    break;
                }
            }
        }

        if ($auth) {
            switch (TRUE) {
                case $methodHasAnnotation:
                    $annotation   = $this->annotations->getMethod($controllerClass, $action)->get(AccessAnnotation::NAME);
                    $isAuthorized = $this->checkAccessAnnotation($annotation, $auth->getUserRole());
                    break;
                case $classHasAnnotation:
                    $annotation   = $this->annotations->get($controllerClass)->getClassAnnotations()->get(AccessAnnotation::NAME);
                    $isAuthorized = $this->checkAccessAnnotation($annotation, $auth->getUserRole());
                    break;
                default:
                    $isAuthorized = TRUE;
                    break;
            }

            if (!$isAuthorized) {
                $this->dispatcher->forward(array("controller" => "errors", "action" => "error403"));
            }

        } else {
            switch (TRUE) {
                case $methodHasAnnotation || $classHasAnnotation:
                    $this->dispatcher->forward(array("controller" => "errors", "action" => "error401"));
                    $isAuthorized = FALSE;
                    break;
                default:
                    $isAuthorized = TRUE;
                    break;
            }
        }

        //zapisati u apc -- controller - action - role = true il false

        return $isAuthorized;
    }

    private function checkAccessAnnotation(Annotation $annotation, $currentUserRole)
    {
        $isAuthorized = FALSE;
        $accessRoles  = $annotation->getArgument(AccessAnnotation::ROLES);

        if ($accessRoles == NULL) {
            $this->dispatcher->forward(array("controller" => "errors", "action" => "error500")); //pass parameters?

            return FALSE;
        } else {
            foreach ($accessRoles as $currentAccessRole) {
                if ($currentAccessRole == $currentUserRole) {
                    $isAuthorized = TRUE;
                    break;
                }
            }
        }

        return $isAuthorized;
    }

}