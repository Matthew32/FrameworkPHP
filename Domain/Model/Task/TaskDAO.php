<?php

namespace Domain\Model\Task;

use Database\Abstracts\DAO;
use Database\Interfaces\IActionsDatabase;
use Database\Interfaces\IDatabase;
use Database\Interfaces\IEntity;

class TaskDAO extends DAO
{
    public function __construct(IDatabase $Database)
    {
        parent::__construct($Database, Task::class);
    }

    public function getAllByUser($task)
    {
        $result = null;
        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user,date_created,date_updated FROM tasks where id_user = ?");
        $gsent->execute([$task->user]);

        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));

    }

    public function getAllByUserOnDate($task, $date)
    {
        $result = null;
        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user,date_created,date_updated FROM tasks where id_user = ? and date_created >= ? and ? <= date_created");
        $gsent->execute([$task->user, $date, $date]);

        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));

    }

    public function getByUser($task)
    {
        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user ,date_created,date_updated  FROM tasks where id = ? and id_user = ?");

        $gsent->execute([$task->id, $task->user]);

        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function update($task)
    {
        $this->Database->getConnection()->prepare('UPDATE tasks SET text=?, duration = ? WHERE id=?')->execute([$task->text, $task->duration, $task->id]);
        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user,date_created,date_updated  FROM tasks where id_user = ?");
        $gsent->execute([$task->user]);

        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function remove($task)
    {
        // TODO: Implement remove() method.
    }

    public function saveTask($task)
    {
        //is saved already
        try {
            $savedTask = $this->Database->getConnection()->prepare("SELECT id,duration  FROM tasks where text = ?  and (date_created BETWEEN ? AND ? ) and id_user = ?");

            $savedTask->execute([trim($task->text), date("Y-m-d") . " 00:00:00", date("Y-m-d") . " 23:59:00", $task->user]);

            $idSavedTask = $savedTask->fetch(\PDO::FETCH_ASSOC);

            if ($idSavedTask) {
                //update
                $durationCalculation = floatval($task->duration) + floatval($idSavedTask["duration"]);

                $result = $this->update(new Task($idSavedTask["id"], $task->text, $task->user, $durationCalculation));
            } else {
                //insert
                $result = $this->insert($task);
            }
        } catch (\Exception $e) {

            $result = false;
        }
        return $result;
    }

    public function insert($task)
    {

        $insert = $this->Database->getConnection()->prepare("INSERT INTO tasks(text, duration,id_user) VALUES (?,?, ?)");

        $insert->execute([$task->text, $task->duration, $task->user]);

        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user,date_created,date_updated  FROM tasks where id_user = ?");
        $gsent->execute([$task->user]);

        /* Agrupar valores según la primera columna */
        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));
    }


    public function get($id)
    {
        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user ,date_created,date_updated  FROM tasks where id = ? ");

        $gsent->execute([$id]);

        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));
    }

    public function getAll()
    {
        $result = null;
        $gsent = $this->Database->getConnection()->prepare("SELECT id,text,duration,id_user as user,date_created,date_updated FROM tasks");
        $gsent->execute();

        return $this->format($gsent->fetchAll(\PDO::FETCH_ASSOC));
    }
}