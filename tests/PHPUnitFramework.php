<?php
/**
 * Created by PhpStorm.
 * User: mateomartinezmiranda
 * Date: 05/09/2019
 * Time: 13:29
 */

namespace Test;

use Database\Classes\Database;

error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_PARSE & ~E_DEPRECATED);

class PHPUnitFramework extends \PHPUnit\Framework\TestCase
{
    protected $DBContext;

    protected function dbConnection()
    {
        $this->DBContext = Database::getConnection();
        return $this->DBContext;
    }

    /**
     * On Start set up the db connection
     */
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->dbConnection();
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
