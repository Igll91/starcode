<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 20/04/16
 * Time: 23:03
 */

namespace Starcode\Validation;

use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class PasswordValidator extends Validator implements ValidatorInterface
{
    const ALGORITHM      = "algo";
    const CHECK_PASSWORD = "checkPassword";
    const SALT           = "salt";
    const MESSAGE        = "message";
    const ALLOW_EMPTY    = "allowEmpty";

    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value      = trim($validator->getValue($attribute));
        $allowEmpty = $this->getOption(self::ALLOW_EMPTY) ?: FALSE;
        $algo       = $this->getOption(self::ALGORITHM) ?: PASSWORD_BCRYPT;
        $message    = $this->getOption(self::MESSAGE) ?: "You entered incorrect password";

        if (!$this->hasOption(self::CHECK_PASSWORD)) {
            throw new \InvalidArgumentException("checkPassword not set");
        }

        if ($this->hasOption(self::SALT)) {
            $inputPassword = password_hash($value, $algo, array("salt" => $this->getOption(self::SALT)));
        } else {
            $inputPassword = password_hash($value, $algo);
        }

        if ($allowEmpty && $value == "") {
            return TRUE;
        }

        if ($this->getOption(self::CHECK_PASSWORD) != $inputPassword) {
            $validator->appendMessage(new Message($message, $attribute, 'Password'));

            return FALSE;
        }

        return TRUE;
    }

}