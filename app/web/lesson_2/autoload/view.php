<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 1:45 PM
 */

function __autoload($classname)
{
    include $classname . '.php';
}

$obj_1 = new A("Я объект класса A");
$obj_1->view();

$obj_2 = new B("Я объект класса B");
$obj_2->view();
