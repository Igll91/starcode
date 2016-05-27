<?php
namespace Starcode\Forms;

use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Starcode\Models\Role;

/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 15/04/16
 * Time: 02:09
 */
class RoleForm extends Form
{

    public function initialize(Role $role = NULL, $options = NULL)
    {
        if (isset($options['edit']) && $options['edit']) {
            $this->add(new Hidden('id'));
        }

        // NAME
        $name = new Text("name");
        $name->addValidator(new PresenceOf(array('message' => $this->trans->_("role.validation.error.pressenceof"))));
        $name->setLabel($this->trans->_("role.name.label"));
        $name->setAttribute("size", 30);
        $name->setAttribute("class", "form-control");
        // https://github.com/phalcon/cphalcon/issues/11334
//        $name->addValidator(new Uniqueness(array("message" => "unique.error.key", "model" => Role::class)));
        $this->add($name);


        // Add a text element to put a hidden CSRF
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