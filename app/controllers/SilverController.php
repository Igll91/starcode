<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 04/05/16
 * Time: 20:20
 */

namespace Starcode\Controllers;

use Starcode\library\Auth\AccessAnnotation;

/**
 * Users that have silver level paid service.
 *
 * Class SilverLevelUsersController
 *
 * @Access(roles={"SUPER_ADMIN", "SILVER_USER"})
 *
 * @package Starcode\Controllers
 */
class SilverController extends ControllerBase
{
    public function indexAction(){

    }
}