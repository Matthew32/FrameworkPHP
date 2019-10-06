<?php

namespace Domain\Model\User;

use Database\Abstracts\DAO;
use Database\Interfaces\IDatabase;
use Domain\Model\Task\Task;

class UserDAO extends DAO
{
    public function __construct(IDatabase $Database)
    {
        parent::__construct($Database, User::class);
    }


    public function addToken($user)
    {

        $savedToken = $this->Database->getConnection()->prepare("SELECT s.key FROM users s  where  ip = ?");
        $savedToken->execute([$user->ip]);

        $idSavedToken = $savedToken->fetch(\PDO::FETCH_ASSOC);

        if (!$idSavedToken) {
            $insert = $this->Database->getConnection()->prepare("INSERT INTO users(`key`,`ip`) VALUES (?,?)");
            $key = $this->generateToken($user->ip);
            $insert->execute([$key, $user->ip]);
            $result = $key;
        } else {
            $result = $idSavedToken["key"];
        }
        return $result;
    }

    protected function generateToken($data)
    {
        return password_hash(date("Y-m-d H:i:s") . $data, PASSWORD_BCRYPT, ["cost" => 12]);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    public function insert($class)
    {
        // TODO: Implement insert() method.
    }

    public function update($class)
    {
        // TODO: Implement update() method.
    }

    public function remove($id)
    {
        // TODO: Implement remove() method.
    }
}