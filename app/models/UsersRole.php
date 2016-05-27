<?php

namespace Starcode\Models;

class UsersRole extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $users_id;

    /**
     *
     * @var integer
     */
    protected $role_id;


    public function __toString()
    {
        return $this->getUsersId() . " : " . $this->role_id;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field users_id
     *
     * @param integer $users_id
     * @return $this
     */
    public function setUsersId($users_id)
    {
        $this->users_id = $users_id;

        return $this;
    }

    /**
     * Method to set the value of field role_id
     *
     * @param integer $role_id
     * @return $this
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;

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
     * Returns the value of field users_id
     *
     * @return integer
     */
    public function getUsersId()
    {
        return $this->users_id;
    }

    /**
     * Returns the value of field role_id
     *
     * @return integer
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('role_id', 'Starcode\Models\Role', 'id', array('alias' => 'Role', 'foreignKey' => TRUE));
        $this->belongsTo('users_id', 'Starcode\Models\Users', 'id', array('alias' => 'Users', 'foreignKey' => TRUE));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsersRole[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return UsersRole
     */
    public static function findFirst($parameters = null)
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
        return 'users_role';
    }

}
