<?php

namespace TaskAPI\Task\Controller;

use Utils\Interfaces\IController;
use TaskAPI\Task\Actions\TaskActions;
use  \Utils\JSON;

class TaskController
{

    protected $action;

    public function __construct()
    {
        $this->action = new TaskActions();

    }

    public function index($request)
    {
        $result = new JSON(401, "not authorized");
        $error = !isset($request->paramsGet()["user_id"]);

        if (!$error) {
            $content = $this->action->getAllItemsByDate($request->paramsGet()["user_id"]);
            $result = $content ? new JSON(200, $content) : new JSON(203, "Data not found");
        }
        $result->send();
    }

    public function getById($request)
    {
        $result = new JSON(401, "not authorized");
        $error = !isset($request->paramsGet()["user_id"]);

        if (!$error) {
            $content = $this->action->getItem($request->id, $request->paramsGet()["user_id"]);
            $result = $content ? new JSON(200, $content) : new JSON(203, "Data not found");
        }
        $result->send();
    }

    public function save($request, $response, $service)
    {
        $result = new JSON(400, "empty parameters");
        $error = !isset($request->paramsPost()["text"]) || !isset($request->paramsPost()["duration"]);

        if (!$error) {

            $content = $this->action->saveItem(
                $request->paramsPost()["text"],
                $request->paramsGet()["user_id"],
                $request->paramsPost()["duration"]
            );
            $result = $content ? new JSON(200, $content) : new JSON(203, "Data not found");
        }

        $result->send();
    }

}