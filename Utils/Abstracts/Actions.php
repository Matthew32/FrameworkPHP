<?php

namespace Utils\Abstracts;
use Database\Classes\Database;
abstract class Actions
{
    protected  $db;
    public function __construct()
    {
        $this->db =new Database(
            $_ENV["database"]["connection"],
            $_ENV["database"]["name"],
            $_ENV["database"]["username"],
            $_ENV["database"]["password"]
        );
    }


}