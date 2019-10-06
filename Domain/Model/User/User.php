<?php

namespace Domain\Model\User;

use Database\Classes\Entity;
use Database\Interfaces\ISetUpEntity;


class User extends Entity implements ISetUpEntity
{
    public $key;
    public $ip;

    public $date_created;
    public $date_updated;

    public function __construct($id = null, $key = null, $ip = null)
    {
        parent::__construct($id);
        $this->key = $key;
        $this->ip = $ip;
    }
}
