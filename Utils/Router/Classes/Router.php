<?php

namespace Utils\Router\Classes;

use Utils\Router\Interfaces\IRoutes;

class  Router implements IRoutes
{

    public function setUp($content)
    {
        $klein = new \Klein\Klein();

        $klein->onHttpError(function ($code, $router) {
            switch ($code) {
                case 404:
                    $router->response()->body(
                        '404 not found'
                    );
                    break;
                case 405:
                    $router->response()->body(
                        'Not allowed'
                    );
                    break;
                default:
                    $router->response()->body(
                        'Bad Error:' . $code
                    );
            }
        });

        foreach ($content as $value) {

            $klein->respond($value[0], $value[1], function ($request, $response, $service) use ($value) {

                $methodName = $value[3];
                $class = new $value[2];

                $class->$methodName($request, $response, $service);


                $service->escape = function ($str) {
                    return htmlentities($str); // Assign view helpers
                };
                if (isset($value[4])) {
                    $service->render = $value[4];

                    $service->render(__DIR__ . '/../../../Web/views/layout/app.php');
                }

            });
        }
        $klein->dispatch();
    }
}