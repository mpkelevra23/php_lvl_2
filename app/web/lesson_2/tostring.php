<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 12:22 PM
 */
class MyClass
{
    public function __toString()
    {
        return 'MyClass class';
    }
}

$obj = new MyClass();
echo $obj; //Результат: MyClass class