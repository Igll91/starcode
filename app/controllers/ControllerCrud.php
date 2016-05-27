<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 25/04/16
 * Time: 22:15
 */

namespace Starcode\Controllers;

use Phalcon\Forms\Form;
use Phalcon\Logger\Adapter\File;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Criteria;

use Phalcon\Paginator\Adapter\Model as Paginator;
use Starcode\Models\IIdentifier;

abstract class ControllerCrud extends ControllerBase
{
    const INDEX_ACTION  = "index";
    const EDIT_ACTION   = "edit";
    const NEW_ACTION    = "new";
    const SEARCH_ACTION = "search";

    /** @var \ReflectionClass */
    private $formReflection;

    /** @var \ReflectionClass */
    private $modelReflection;

    /** @var \ReflectionClass */
    private $controllerReflection;

    private $logger;

    public function setControllerName($controllerClass, $formClass, $modalClass)
    {
        $this->formReflection       = new \ReflectionClass($formClass);
        $this->modelReflection      = new \ReflectionClass($modalClass);
        $this->controllerReflection = new \ReflectionClass($controllerClass);
    }

    public function initialize()
    {
        parent::initialize();
        $this->view->modelName = $this->getModelTranslationName();
        $this->logger          = new File(APP_PATH . "/app/logs/crud.log");
    }

    /**
     * CRUD index action
     */
    public function indexAction()
    {
        $formClassName                = $this->formReflection->getName();
        $this->persistent->parameters = NULL;
        $this->view->form             = new $formClassName();

        $this->view->pick("crud/index");
    }

    /**
     * CRUD Searches for model
     */
    public function searchAction()
    {
        $modelClassName = $this->modelReflection->getName();
        $numberPage     = 1;

        if ($this->request->isPost()) {
            $query                        = Criteria::fromInput($this->di, $modelClassName, $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";
        $modelObject         = $modelClassName::find($parameters);
        if (count($modelObject) == 0) {
            $this->flash->notice($this->getDI()->get('trans')->_('action.search.empty'));
            $this->dispatcher->forward(array("controller" => $this->getControllerCleanName(), "action" => self::INDEX_ACTION));

            return;
        }

        $paginator = new Paginator(array('data' => $modelObject, 'limit' => 10, 'page' => $numberPage));

        $this->view->page = $paginator->getPaginate();

        //TODO: DB field JSON -> sadrži polja koja se prikazivaju u tablici

        $this->view->pick("crud/search");
    }

    /**
     * CRUD displays the creation form
     */
    public function newAction()
    {
        $formClassName    = $this->formReflection->getName();
        $this->view->form = new $formClassName;

        $this->view->pick("crud/new");
    }

    /**
     * CRUD edits a model
     *
     * @param string $id
     */
    public function editAction($id)
    {
        $modelClassName = $this->modelReflection->getName();
        $formClassName  = $this->formReflection->getName();

        if (!$this->request->isPost()) {
            $modelObject = $modelClassName::findFirstByid($id);
            if ($this->forwardIfModelNotFound($modelObject, $this->trans->t(strtolower($this->getControllerCleanName())), $this->getControllerCleanName(), self::indexAction())) {
                return;
            }

            $form             = new $formClassName($modelObject, array("edit" => TRUE));
            $this->view->form = $form;
        }

        $this->view->pick("crud/edit");
    }

    /**
     * CRUD creates a new model
     */
    public function createAction()
    {

        $modelClassName = $this->modelReflection->getName();
        $formClassName  = $this->formReflection->getName();
        $modelObject    = new $modelClassName();
        $form           = new $formClassName($modelObject);

        $form->bind($_POST, $modelObject);

        if (!$this->validateForm($form, $this->getControllerCleanName(), self::NEW_ACTION) || !$this->saveModel($modelObject, $this->getControllerCleanName(), self::NEW_ACTION)) {
            return;
        }

        $identifier = ($modelObject instanceof IIdentifier) ? $modelObject->getIdentifierValue() : NULL;
        $this->logger->info($this->getCurrentUser() . " created new model of type " . $modelClassName . " with ID " . $identifier . " from " . json_encode(array("client_address" => $this->request->getClientAddress(), "user_agent" => $this->request->getUserAgent())));

        $this->flash->success($this->trans->t($this->getModelTranslationName() . ".created"));
        $this->dispatcher->forward(array('controller' => $this->getControllerCleanName(), 'action' => self::INDEX_ACTION));
    }

    /**
     * CRUD saves a model edited
     *
     */
    public function saveAction()
    {
        $modelClassName = $this->modelReflection->getName();
        $formClassName  = $this->formReflection->getName();

        if ($this->forwardIfNotPost($this->getControllerCleanName(), self::INDEX_ACTION)) {
            return;
        }

        $id          = $this->request->getPost("id");
        $modelObject = $modelClassName::findFirstByid($id);
        $form        = new $formClassName($modelObject);

        if ($this->forwardIfModelNotFound($modelObject, $this->trans->t($this->getModelTranslationName()), $this->getControllerCleanName(), self::INDEX_ACTION)) {
            return;
        }

        $form->bind($_POST, $modelObject);

        if (!$this->validateForm($form, $this->getControllerCleanName(), self::SEARCH_ACTION, array($modelObject->getId())) || !$this->saveModel($modelObject, $this->getControllerCleanName(), self::SEARCH_ACTION, array($modelObject->getId()))) {
            return;
        }

        $identifier = ($modelObject instanceof IIdentifier) ? $modelObject->getIdentifierValue() : NULL;
        $this->logger->info($this->getCurrentUser() . " edited model of type " . $modelClassName . " with ID " . $identifier . " from " . json_encode(array("client_address" => $this->request->getClientAddress(), "user_agent" => $this->request->getUserAgent())));

        $this->flash->success($this->trans->t($this->getModelTranslationName() . ".updated"));
        $this->dispatcher->forward(array('controller' => $this->getControllerCleanName(), 'action' => self::INDEX_ACTION));
    }

    /**
     * CRUD deletes a model
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $modelClassName = $this->modelReflection->getName();
        $modelObject    = $modelClassName::findFirstByid($id);

        if ($this->forwardIfModelNotFound($modelObject, $this->trans->t($this->getModelTranslationName()), $this->getControllerCleanName(), self::INDEX_ACTION)) {
            return;
        }

        if (!$modelObject->delete()) {
            foreach ($modelObject->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward(array('controller' => $this->getControllerCleanName(), 'action' => self::SEARCH_ACTION));

            return;
        }

        $identifier = ($modelObject instanceof IIdentifier) ? $modelObject->getIdentifierValue() : NULL;
        $this->logger->info($this->getCurrentUser() . " deleted model of type " . $modelClassName . " with ID " . $identifier . " from " . json_encode(array("client_address" => $this->request->getClientAddress(), "user_agent" => $this->request->getUserAgent())));

        $this->flash->success($this->trans->t($this->getModelTranslationName() . ".deleted"));
        $this->dispatcher->forward(array('controller' => $this->getControllerCleanName(), 'action' => self::INDEX_ACTION));
    }

    private function getControllerCleanName()
    {
        return str_replace("Controller", "", $this->controllerReflection->getShortName());
    }

    private function getModelTranslationName()
    {
        return strtolower($this->modelReflection->getShortName());
    }
}