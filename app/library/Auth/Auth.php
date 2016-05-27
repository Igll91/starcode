<?php
/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 29/04/16
 * Time: 00:43
 */
namespace Starcode\Library\Auth;

use Phalcon\Logger\AdapterInterface;
use Phalcon\Mvc\User\Component;
use Starcode\Models\Role;
use Starcode\Models\Users;

class Auth extends Component
{
    const AUTH_KEY     = "auth-messaging";
    const LOGIN_AS_KEY = "loginas-messaging";

    private $logger;

    public function __construct(AdapterInterface $logger)
    {
        $this->logger = $logger;
    }

    public function checkUser($username, $password)
    {
        $user = Users::findFirstByEmail($username);

        if (!$user) {
            $this->logger->alert($this->formatMessage("login fail at username: $username"));
            throw new Exception($this->trans->t("auth.credentials.error"));
        }

        $passwordHash = $this->hashPassword($password, $user->getSalt());

        if ($user->getPassword() != $passwordHash) {
            $this->logger->alert($this->formatMessage("login fail for $username with password $password"));
            throw new Exception($this->trans->t("auth.credentials.error"));
        }

        if (!$user->getEnabled()) {
            throw new Exception($this->trans->t("auth.enabled.error"));
        }

        $this->session->set(self::AUTH_KEY, $user);
        $this->logger->info($this->formatMessage("login success for $username"));
    }

    public function getCurrentUser()
    {
        if ($this->session->has(self::LOGIN_AS_KEY)) {
            return $this->session->get(self::LOGIN_AS_KEY);
        } else {
            return $this->session->get(self::AUTH_KEY);
        }
    }

    public function loginAs(Users $users)
    {
        $currentUser = $this->session->get(self::AUTH_KEY);
        if ($currentUser && $currentUser->getRole() == "SUPER_ADMIN") {
            $this->session->set(self::LOGIN_AS_KEY, $users);
        }
    }

    public function hashPassword($password, $salt)
    {
        return password_hash($password, PASSWORD_BCRYPT, array("salt" => $salt));
    }

    private function formatMessage($message)
    {
        $requestData = array(
            "client_address" => $this->request->getClientAddress(),
            "user_agent"     => $this->request->getUserAgent()
        );

        return $message . " data: " . json_encode($requestData);
    }
}