<?php

namespace Database\Abstracts;

use Database\Interfaces\IActionsDatabase;
use Database\Interfaces\IDatabase;

abstract class DAO implements IActionsDatabase
{
    protected $modelClassName;
    protected $Database;

    public function __construct(IDatabase $Database, string $modelClassName)
    {
        $this->Database = $Database;
        $this->modelClassName = $modelClassName;
    }

    public function format($data)
    {
        $result = [];

        foreach ($data as $value) {
            $class = new $this->modelClassName();
            $reflect = new \ReflectionClass($class);
            $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
            foreach ($props as $attribute) {
                $name = $attribute->getName();
                if (isset($value[$name])) {
                    $class->$name = $value[$name];
                }
            }

            $result[] = $class;

        }
        return $result;
    }
}