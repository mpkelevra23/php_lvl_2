<?php

/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 7:04 PM
 */
class MyClass
{
    public function names(array $names)
        //Тип array
    {
        $res = "<ul>";
        foreach ($names as $name) {
            $res .= "<li>{$name}</li>";
        }
        return $res .= "</ul>";
    }

    public function otherClassTypeFunc(OtherClass $otherClass)
    {//Тип OtherClass
        return $otherClass->var1;
    }
}

$obj = new MyClass();
$names = [
    'Иван Андреев',
    'Олег Симонов',
    'Андрей Ефремов',
    'Алексей Самсонов'
];

echo $obj->names($names);

$obj->otherClassTypeFunc($obj);//Получим ошибку
