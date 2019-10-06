<?php

namespace Domain\Model\Task;

use Database\Classes\Entity;
use Database\Interfaces\ISetUpEntity;


class Task extends Entity implements ISetUpEntity
{
    public $text;
    public $duration;
    public $date_created;
    public $date_updated;
    public $user;

    public function __construct($id = null, $text = null, $user = null, $duration = null)
    {
        parent::__construct($id);
        $this->text = $text;
        $this->user = $user;
        $this->duration = $duration;

    }


}