<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 6:25 PM
 */

interface Int1
{
    function fun1();
}

interface Int2
{
    function fun2();
}

class Test implements Int1, Int2
{
    public function fun1()
    {
        return 1;
    }

    public function fun2()
    {
        return 2;
    }
}

$obj = new Test();
echo $obj->fun1() . '<br>';
echo $obj->fun2() . '<br>';

interface Int3
{
    function fun1();
}

interface Int4 extends Int3
{
    function fun2();
}

class Check implements Int4
{
    public function fun1()
    {
        return 1;
    }

    public function fun2()
    {
        return 2;
    }
}

$obj = new Check();
echo $obj->fun1() . '<br>';
echo $obj->fun2() . '<br>';