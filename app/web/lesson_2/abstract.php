<?php

/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 11:20 AM
 */
abstract class MyAbstractClass
{
    abstract protected function getValue();

    public function printValue()
    {
        print $this->getValue() . "\n";
    }
}

class ChildClass extends MyAbstractClass
{
    protected function getValue()
    {
        return "ChildClass";
    }
}

$obj = new ChildClass();
$obj->printValue();