<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 01/05/16
 * Time: 13:35
 */

namespace Starcode\library\Auth;

use Phalcon\Annotations\Annotation;

class AccessAnnotation extends Annotation
{
    const NAME  = "Access";
    const ROLES = "roles";

    public function getName()
    {
        return self::NAME;
    }

}