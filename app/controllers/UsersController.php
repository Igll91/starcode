<?php
namespace Starcode\Controllers;

use Phalcon\Logger\Adapter\File;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Starcode\Forms\UserForm;
use Starcode\Models\Users;

use Starcode\library\Auth\AccessAnnotation;

/**
 * Class UsersController
 *
 * @Access(roles={"SUPER_ADMIN"})
 *
 * @package Starcode\Controllers
 */
class UsersController extends ControllerCrud
{

    private $logger;

    public function onConstruct()
    {
        parent::setControllerName(__CLASS__, UserForm::class, Users::class);

        $this->logger = new File(APP_PATH . "/app/logs/crud.log");
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = NULL;
    }

    /**
     * Searches for users
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query                        = Criteria::fromInput($this->di, '\Starcode\Models\Users', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $users = Users::find($parameters);
        if (count($users) == 0) {
            $this->flash->notice($this->getDI()->get('trans')->_('action.search.empty'));
            $this->dispatcher->forward(array("controller" => "users", "action" => "index"));

            return;
        }

        $paginator = new Paginator(array('data' => $users, 'limit' => 10, 'page' => $numberPage));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction()
    {
        /* @var $user Users */

        if ($this->forwardIfNotPost("users", "index")) {
            return;
        }

        $id   = $this->request->getPost("id");
        $user = Users::findFirstByid($id);

        if ($this->forwardIfModelNotFound($user, $this->trans->t("users.whom"), "users", "index")) {
            return;
        }

        $form = new UserForm($user, array("edit" => TRUE));

        $form->bind($_POST, $user); // whitelist? potreban iako je forma definirana?

        $newPassword = trim($form->get('newPassword')->getValue());
        if ($newPassword) {
            $hashedPassword = $this->getDI()->get('auth')->hashPassword($newPassword, $user->getSalt());
            $user->setPassword($hashedPassword);
        }

        switch (TRUE) {
            case (!$this->validateForm($form, "users", "edit", array("id" => $user->getId(), "form" => $form))):
                return;
            case (!$this->saveModel($user, "users", "edit", array("id" => $user->getId(), "form" => $form))):
                return;
        }

        $this->logger->info($this->getCurrentUser() . " edited model of type " . Users::class . " with ID " . $user->getIdentifierValue() . " from " . json_encode(array("client_address" => $this->request->getClientAddress(), "user_agent" => $this->request->getUserAgent())));

        $this->flash->success($this->trans->t("users.updated"));
        $this->dispatcher->forward(array('controller' => "users", 'action' => 'index'));
    }


}
