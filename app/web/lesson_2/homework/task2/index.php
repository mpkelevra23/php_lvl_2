<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 2/6/19
 * Time: 9:43 PM
 */

trait Singleton
{
    private static $instance;

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }
}

class Test
{
    use Singleton;
}

$obj_1 = Test::getInstance();
$obj_2 = Test::getInstance();

var_dump($obj_1 === $obj_2);    // Вернёт true, так как это один и тот же объект данного класса
