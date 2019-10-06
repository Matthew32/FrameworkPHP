<?php

namespace TaskWeb\User\Actions;

use Domain\Model\User\User;
use Domain\Repositories\UserRepository;
use \Utils\Abstracts\Actions;

class UserActions extends Actions
{
    private $repository;

    public function __construct()
    {
        parent::__construct();

        $this->repository = new UserRepository($this->db);

    }

    public function addToken($ip)
    {
        return $this->repository->generateToken(new User(0, null, $ip));
    }
}