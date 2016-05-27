<?php

namespace Starcode\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Starcode\Library\PhalconTimeStampable;

/**
 * Users
 *
 * @package       Starcode\Models
 * @autogenerated by Phalcon Developer Tools
 * @date          2016-04-29, 00:20:18
 */
class Users extends \Phalcon\Mvc\Model implements IIdentifier
{

    use PhalconTimeStampable;

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var integer
     */
    protected $enabled;

    /**
     *
     * @var string
     */
    protected $salt;

    /**
     *
     * @var integer
     */
    protected $role;

    public function __toString()
    {
        return $this->name;
    }

    public function getIdentifierValue()
    {
        return $this->id;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field enabled
     *
     * @param integer $enabled
     *
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Method to set the value of field salt
     *
     * @param string $salt
     *
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Method to set the value of field created
     *
     * @param string $created
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Method to set the value of field updated
     *
     * @param string $updated
     *
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Method to set the value of field role
     *
     * @param integer $role
     *
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Returns the value of field salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Returns the value of field created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Returns the value of field updated
     *
     * @return string
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Returns the value of field role
     *
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('role', 'Starcode\Models\Role', 'id', array('alias' => 'Role'));
    }

    /**
     * Return the related "Role"
     *
     * @return Role
     */
    public function getUserRole($parameters = null)
    {
        return $this->getRelated('Role', $parameters);
    }

    public function beforeSave()
    {
        //checkbox form returns string 'on' for checked state
        $this->enabled = $this->enabled ? 1 : 0;
    }


    public function beforeValidationOnCreate()
    {
        $this->setSalt(uniqid("s_", TRUE));
    }


    public function afterValidationOnCreate()
    {
        $hashedPassword = $this->getDI()->get('auth')->hashPassword($this->getPassword(), $this->getSalt());
        $this->setPassword($hashedPassword);
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => TRUE,
                )
            )
        );

        $this->validate(new Uniqueness(array(
                                           "field"   => "email",
                                           "message" => $this->getDI()->get('trans')->_('role.unique.error')
                                       )));

        if ($this->validationHasFailed() == TRUE) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Users[]
     */
    public static function find($parameters = NULL)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     *
     * @return Users
     */
    public static function findFirst($parameters = NULL)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

}
