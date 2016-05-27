<?php
namespace Starcode\Controllers;

use Phalcon\Forms\Form;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model;

class ControllerBase extends Controller
{
    public function initialize()
    {
    }

    /**
     * Forward toward given controller action if request method is not POST.
     *
     * @param $controller string Forward destination Controller.
     * @param $action     string Forward destination Action.
     *
     * @return bool True when forwarded, false otherwise.
     */
    protected function forwardIfNotPost($controller, $action)
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward(array('controller' => $controller, 'action' => $action));

            return TRUE;
        } else {
            return FALSE;
        }
    }

    protected function forwardIfModelNotFound($model, $modelName, $controller, $action, $params = NULL)
    {
        if (!$model) {
            $this->flash->error($this->trans->t("model.not.found", array("modelName" => $this->trans->t($modelName . ".what"))));
            $this->prepareForward($controller, $action, $params);

            return TRUE;
        } else {
            return FALSE;
        }

    }

    protected function saveModel(Model $model, $controller, $action, $params = NULL)
    {
        if (!$model->save()) {
            foreach ($model->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->prepareForward($controller, $action, $params);

            return FALSE;
        } else {
            return TRUE;
        }
    }

    protected function validateForm(Form $form, $controller, $action, $params = NULL)
    {
        if (!$form->isValid()) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->prepareForward($controller, $action, $params);

            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function prepareForward($controller, $action, $params = NULL)
    {
        $forwardArray = ["controller" => $controller, "action" => $action];
        if ($params) {
            $forwardArray["params"] = $params;
        }

        $this->dispatcher->forward($forwardArray);
    }

    public function getCurrentUser()
    {
        return $this->auth->getCurrentUser();
    }
}
