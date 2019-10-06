<?php

namespace TaskAPI\Task\Actions;

use Domain\Model\Task\Task;
use \Utils\Abstracts\Actions;
use Domain\Repositories\TaskRepository;

class TaskActions extends Actions
{
    private $repository;

    public function __construct()
    {
        parent::__construct();

        $this->repository = new TaskRepository($this->db);

    }

    public function getAllItemsByDate($idUser)
    {
        $task = new Task();
        $task->user = $idUser;

        return $this->repository->getAllByUserOnDate($task, date("Y-m-d"));
    }

    public function getItem($id, $idUser)
    {
        $task = new Task($id);
        $task->user = $idUser;

        return $this->repository->getOneByUser($task);
    }

    public function saveItem($text, $userID, $duration)
    {
        $tasks = new Task(0, $text, $userID, $duration);
        return $this->repository->saveItem($tasks);
    }
}