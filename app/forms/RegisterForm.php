<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 04/05/16
 * Time: 23:32
 */

namespace Starcode\Forms;

use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Starcode\Models\Users;

class RegisterForm extends Form
{

    public function initialize(Users $users = NULL, $options = NULL ){
        // NAME
        $name = new Text("name");
        $name->setFilters(array('striptags', 'string'));
        $name->setLabel($this->trans->t("users.name.label"));
        $name->addValidator(new PresenceOf(array('message' => $this->trans->_("users.name.presence.error"))));
        $this->add($name);

        $email = new Email("email");
        $email->addFilter("email");
        $email->setLabel($this->trans->t("users.email.label"));
        $email->addValidator(new \Phalcon\Validation\Validator\Email(array("message" => $this->trans->_("users.email.error"))));
        $email->addValidator(new Uniqueness(array('model' => Users::class, 'message' => $this->trans->_("users.email.unique.error"))));
        $this->add($email);

        $password = new Password("password");
        $password->setFilters(array('striptags', 'string'));
        $password->setLabel($this->trans->t("users.password.label"));
        $password->addValidator(new PresenceOf(array("message" => $this->trans->_("users.password.presence.error"))));
        $password->addValidator(new Confirmation(array("with" => "confirmPassword", "message" => $this->trans->_("users.confirmpassword.notequal.error"))));
        $this->add($password);

        // Confirm Password
        $confirmPassword = new Password('confirmPassword');
        $confirmPassword->setFilters(array('striptags', 'string'));
        $confirmPassword->setLabel($this->trans->t("users.confirmpassword.label"));
        $this->add($confirmPassword);

        $this->add(new Hidden("csrf"));
    }

    /**
     * This method returns the default value for field 'csrf'
     */
    public function getCsrf()
    {
        return $this->security->getToken();
    }

}