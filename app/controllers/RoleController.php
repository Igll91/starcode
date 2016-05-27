<?php

namespace Starcode\Controllers;

use Starcode\Forms\RoleForm;
use Starcode\Models\Role;

use Starcode\library\Auth\AccessAnnotation;

/**
 * Class RoleController
 *
 * @Access(roles={"SUPER_ADMIN"})
 *
 * @package Starcode\Controllers
 */
class RoleController extends ControllerCrud
{

    public function onConstruct()
    {
        parent::setControllerName(__CLASS__, RoleForm::class, Role::class);
    }

}
