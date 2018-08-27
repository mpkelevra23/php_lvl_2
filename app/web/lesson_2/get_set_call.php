<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 1:17 PM
 */

class Main
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function view()
    {
        echo "<p>$this->name</p>";
    }

    public function __get($name)
    {
        echo "<p>В классе нет свойства $name</p>";
    }

    public function __set($name, $value)
    {
        var_dump($name, $value);
        var_dump($this->name = $value);

    }

    public function __call($name, $arguments)
    {
        echo "<p>У класса нет метода $name</p>";
    }
}

$lol = new Main("check");
echo $lol->b;
$lol->view();
$lol->a = 'lol';
$lol->view();
$lol->f(1, 2, 3);

echo '<hr>';

class MyClass
{
    public $c = "c value" . '<br>';
    public function __set($name, $value)
    {
        return "__set, property - {$name} is not exist" . '<br>';
    }

    public function __get($name)
    {
        return "__get, property - {$name} is not exist" . '<br>';
    }

    public function __call($name, $arguments)
    {
        return "__call, method - {$name} is not exist" . '<br>';
    }

    public function getId()
    {
        return "12";
    }
}

$obj = new MyClass();
echo $obj->z = 1; //Запись в свойство (свойство не существует)
echo $obj->b; //Получаем значение свойства (свойство не существует)
echo $obj->c; //Получаем значение свойства (свойство существует)
echo $obj->getName(); //Вызов метода (метод не существует)
echo $obj->getId(); //Вызов метода (метод существует)