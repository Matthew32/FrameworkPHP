<?php

namespace Domain\Repositories;

use Database\Interfaces\IDatabase;
use Database\Interfaces\IRepository;
use Domain\Model\User\UserDAO;

class UserRepository implements IRepository
{
    protected $model;

    public function __construct(IDatabase $db)
    {
        $this->model = new UserDAO($db);
    }

    public function generateToken($user)
    {
        return $this->model->addToken($user);
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function getOne(int $id)
    {
        // TODO: Implement getOne() method.
    }
}