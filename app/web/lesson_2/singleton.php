<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 2:55 PM
 */

class Test
{
    protected static $object;

    private function __construct()
    {

    }

    public static function getObject()
    {
        if (Test::$object === null) {
            Test::$object = new Test();
        }
        return Test::$object;
    }

    public function demo()
    {
        echo "test";
    }
}

$obj = Test::getObject();
$obj->demo();

echo '<hr>';

class SomeClass
{
    protected static $_instance;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }
}

SomeClass::getInstance();