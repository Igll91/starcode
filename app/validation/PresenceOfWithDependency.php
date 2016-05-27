<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 21/04/16
 * Time: 00:17
 */

namespace Starcode\Validation;

use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class PresenceOfWithDependency extends Validator implements ValidatorInterface
{
    const DEPENDENCY = "dependency";
    const MESSAGE    = "message";

    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value   = trim($validator->getValue($attribute));
        $message = $this->getOption(self::MESSAGE) ?: "Field can not be empty";

        if ($this->hasOption(self::DEPENDENCY)) {
            $depenencyValue = trim($validator->getValue($this->getOption(self::DEPENDENCY)));

            if ($depenencyValue === "") {
                return TRUE;
            } else {
                if ($value === "") {
                    $validator->appendMessage(new Message($message, $attribute, 'Password'));

                    return FALSE;
                } else {
                    return TRUE;
                }
            }

        } else {
            if ($value === "") {
                $validator->appendMessage(new Message($message, $attribute, 'Password'));

                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

}