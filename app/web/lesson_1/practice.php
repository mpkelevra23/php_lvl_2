<?php

class Article
{
    public $id;
    public $title;
    public $content;

    function __construct($id, $title, $content)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    function view()
    {
        echo "<h1>$this->title</h1><p>$this->content</p>";
    }

}

$a = new Article(1, 'New article', 'Hello world');
$a->view();

Class A
{
    function Test()
    {
        echo "<p>This is A class</p>";
    }

    function Call()
    {
        $this->Test();
    }
}

class B extends A
{
    function Test()
    {
        echo "<p>This is B class</p>";
    }
}

$a = new A();
$b = new B();

$a->Test();
$a->Call();
$b->Test();
$b->Call();

class MathOperations
{
    const PI = 3.14;

    public static function count($x)
    {
        return ($x >= 0) ? $x : (-1) * $x;
    }

    public static function RangeLength($rad)
    {
        return 2 * $rad * self::PI;
    }
}

echo MathOperations::RangeLength(10) . "<br>";
echo MathOperations::count(-12) . "<br>";
echo MathOperations::PI . "<br>";

Class Man
{
    private $username;
    public static $numMan = 0;

    public function __construct($username)
    {
        $this->username = $username;
        self::$numMan++;
    }
}

echo Man::$numMan . '<br>';
$m = new Man('Maks');
echo Man::$numMan . '<br>';