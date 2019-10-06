<?php

namespace Application;

use Database\Classes\Database;
use TaskWeb\Middlewares\AuthUserMiddleware;

class Bootstrap
{

    public static function init()
    {
        $_ENV = json_decode(file_get_contents("../.env"), true);

        //set routes
        // Fetch method and URI from somewhere
        self::callMiddlewareAuth();
        $router = new \Utils\Router\Classes\Router();
        $router->setUp(include "../routes/routes.php");

    }

    public static function callMiddlewareAuth()
    {
        AuthUserMiddleware::AuthUser();

    }
}
