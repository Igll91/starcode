<?php

namespace Starcode\Controllers;

use Starcode\Forms\RegisterForm;
use Starcode\Library\Auth\Auth;
use Starcode\Library\Auth\Exception;
use Starcode\Models\Role;
use Starcode\Models\Users;

class AuthenticationController extends ControllerBase
{

    public function loginAction()
    {
        if ($this->request->isPost() && $this->security->checkToken()) {
            $username = $this->request->get("email", "email");
            $pasword  = $this->request->get("password");

            try {
                $this->auth->checkUser($username, $pasword);

                return $this->response->redirect("index");
            } catch (Exception $ex) {
                $this->view->error = $ex->getMessage();
            }
        }

    }

    public function loginAsAction()
    {
        //TODO: username... parameter and redirect link get from config

        $email = $this->request->get('username');

        var_dump($email);

        die();
        if ($email) {
            $this->auth->loginAs(Users::findFirstByEmail($email));
        }

        $this->view->disable();

        return $this->response->redirect("index");
    }

    public function exitLoginAsAction()
    {
        $this->session->remove(Auth::LOGIN_AS_KEY);
        $this->view->disable();

        return $this->response->redirect("index");
    }

    public function logoutAction()
    {
        $currentUser = $this->auth->getCurrentUser();

        if ($currentUser) {
            $this->session->remove(Auth::AUTH_KEY);
        }

        $this->response->redirect("authentication/login");
    }

    public function registerAction()
    {
        $this->view->form = new RegisterForm();
    }

    public function checkRegistrationAction()
    {
        $form = new RegisterForm();
        $user = new Users();

        if ($this->request->isPost()) {
            $captchaCode = $this->request->get('captcha_code');
            $securimage  = new \Securimage();

            $form->bind($_POST, $user);

            $user->setRole(20);
            $user->setEnabled(TRUE);

            if ($securimage->check($captchaCode) == FALSE) {
                $this->flash->error($this->trans->t('auth.captcha.error'));
                $this->dispatcher->forward(array("controller" => "authentication", "action" => "register"));

                return;
            }

            if ($this->validateForm($form, "authentication", "register") == FALSE) {
                return;
            }

            if ($this->saveModel($user, "authentication", "register") == FALSE) {
                return;
            }

            $this->flash->success($this->trans->t("auth.registration.completed"));
            $this->dispatcher->forward(array("controller" => "authentication", "action" => "login"));

            return;
        }
    }

}

