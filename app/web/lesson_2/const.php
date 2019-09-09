<?php

/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 7:09 PM
 */
class MyClass
{
    const CONSTANT = 'значение константы';

    function showConstant()
    {
        echo self::CONSTANT . "\n";
    }
}

echo MyClass::CONSTANT . "\n";

$classname = "MyClass";
echo $classname::CONSTANT . "\n";

$class = new MyClass();
$class->showConstant();

echo $class::CONSTANT . "\n";