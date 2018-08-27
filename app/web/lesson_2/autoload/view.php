<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 1:45 PM
 */

function __autoload($classname) {
    include $classname . '.php';
}

$mam = new A("Я объект класса A");
$mam->view();

$lol = new B("Я объект класса B");
$lol->view();