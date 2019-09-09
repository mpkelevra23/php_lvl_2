<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 7:38 PM
 */

class BaseClass
{
    function __construct()
    {
        echo "Конструктор класса BaseClass\n";
    }
}

class SubClass extends BaseClass
{
    function __construct()
    {
        parent::__construct();
        echo "Конструктор класса SubClass\n ";
    }
}

$obj = new BaseClass();
$obj = new SubClass();