<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 6:59 PM
 */
class MyClass
{

}

class NotMyClass
{

}

$a = new MyClass();
var_dump($a instanceof MyClass);
var_dump($a instanceof NotMyClass);

class ParentClass
{

}

class ChildClass extends ParentClass
{

}

$b = new ChildClass();
var_dump($b instanceof ChildClass);
var_dump($b instanceof ParentClass);