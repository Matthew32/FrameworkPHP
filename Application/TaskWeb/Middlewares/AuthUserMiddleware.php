<?php

namespace TaskWeb\Middlewares;

use TaskWeb\User\Actions\UserActions;
use Utils\IP;

class AuthUserMiddleware
{

    public static function AuthUser()
    {
        if (!isset($_COOKIE["tasktoc"])) {
            //generate token
            $action = new UserActions();
            setcookie("tasktoc", $action->addToken(IP::getUserIpAddr()));
        }
    }


}