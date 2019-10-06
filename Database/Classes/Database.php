<?php

namespace Database\Classes;
use PDO;
use \Database\Interfaces\IDatabase;

class Database implements IDatabase
{
    protected $db;

    public function __construct(string $hostname, string $dbName, string $dbUsername, string $dbPassword)
    {
        if (!isset($this->db))
            $this->connection($hostname, $dbName, $dbUsername, $dbPassword);
    }

    protected function connection(string $hostname, string $dbName, string $dbUsername, string $dbPassword)
    {
        $this->db = new PDO("mysql:host=$hostname;dbname=$dbName", $dbUsername, $dbPassword);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line

    }

    public function getConnection()
    {
        return $this->db;
    }
}