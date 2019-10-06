<?php

namespace Domain\Repositories;

use Database\Interfaces\IActionsDatabase;
use Database\Interfaces\IDatabase;
use Database\Interfaces\IEntity;
use Database\Interfaces\IRepository;
use Domain\Model\Task\Task;
use Domain\Model\Task\TaskDAO;

class TaskRepository implements IRepository
{
    protected $model;

    public function __construct(IDatabase $db)
    {
        $this->model = new TaskDAO($db);
    }


    public function getAll()
    {
        return $this->model->getAll();

    }

    public function getOne(int $id)
    {
        return $this->model->get($id);
    }

    public function getAllByUser($task)
    {
        return $this->model->getAllByUser($task);

    }
    public function getAllByUserOnDate($task,$date)
    {
        return $this->model->getAllByUserOnDate($task,$date);

    }
    public function getOneByUser($task)
    {
        return $this->model->getByUser($task);
    }

    public function saveItem($item)
    {
        return $this->model->saveTask($item);
    }
}