<?php
/**
 * Created by PhpStorm.
 * users: silvio
 * Date: 19/04/16
 * Time: 23:35
 */

namespace Starcode\Forms;

use Phalcon\Forms\Element\Check;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\PresenceOf;
use Starcode\Models\Role;
use Starcode\Models\Users;
use Starcode\Validation\PasswordValidator;
use Starcode\Validation\PresenceOfWithDependency;

class UserForm extends Form
{

    public function initialize(Users $user = NULL, $options = NULL)
    {
        $isEdit = isset($options['edit']) && $options['edit'];

        if ($isEdit) {
            $this->add(new Hidden('id'));
        }

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
        $this->add($email);

        if ($isEdit) {

            $oldPassword = new Password("oldPassword");
            $oldPassword->setFilters(array('striptags', 'string'));
            $oldPassword->setLabel($this->trans->t("users.oldpassword.label"));
            $oldPassword->addValidator(new PasswordValidator(array(PasswordValidator::CHECK_PASSWORD => $user->getPassword(), PasswordValidator::SALT => $user->getSalt(), PasswordValidator::ALLOW_EMPTY => TRUE, PasswordValidator::MESSAGE => $this->trans->t("users.password.credentials.error"))));
            $this->add($oldPassword);

            $password = new Password("newPassword");
            $password->setFilters(array('striptags', 'string'));
            $password->setLabel($this->trans->t("users.password.label"));
            $password->addValidator(new PresenceOfWithDependency(array("message" => $this->trans->_("users.newpassword.presence.error"), PresenceOfWithDependency::DEPENDENCY => "oldPassword")));
            $password->addValidator(new Confirmation(array("with" => "confirmPassword", "message" => $this->trans->_("users.passwordconfirmation.notequal.error"))));
            $this->add($password);

        } else {

            $password = new Password("password");
            $password->setFilters(array('striptags', 'string'));
            $password->setLabel($this->trans->t("users.password.label"));
            $password->addValidator(new PresenceOf(array("message" => $this->trans->_("users.password.presence.error"))));
            $password->addValidator(new Confirmation(array("with" => "confirmPassword", "message" => $this->trans->_("users.passwordconfirmation.notequal.error"))));
            $this->add($password);

        }

        // Confirm Password
        $confirmPassword = new Password('confirmPassword');
        $confirmPassword->setFilters(array('striptags', 'string'));
        $confirmPassword->setLabel($this->trans->t("users.confirmpassword.label"));
        $this->add($confirmPassword);

        $roles = new Select("role", Role::find(), array("using" => array('id', 'name')));
        $roles->setLabel($this->trans->t("users.role.label"));
        $roles->setFilters("int");
        $this->add($roles);

        $enabled = new Select("enabled", array(1 => $this->trans->t("yes"), 0 => $this->trans->t("no")));
        $enabled->setLabel($this->trans->t("users.enabled.label"));
        $this->add($enabled);

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