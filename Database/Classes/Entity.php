<?php

namespace Database\Classes;

use Database\Interfaces\IEntity;
use PDO;
use \Database\Interfaces\IDatabase;

abstract class Entity implements IEntity
{
    public $id;

    public function __construct( $id)
    {
        $this->id = $id;

    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }

    public function setUp()
    {
        // TODO: Implement setUp() method.
    }
}