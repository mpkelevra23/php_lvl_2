<?php
/**
 * Date: 8/22/18
 * Time: 12:52 PM
 */

//Задания 1-4
class Game
{
    protected $id;
    protected $name;
    protected $type;
    protected $price;
    protected $description;

    public function __construct($id, $name, $type, $price, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->price = $price;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function view()
    {
        echo "<h1>$this->name</h1><p>$this->type</p><p>$this->price</p>";
    }
}

$a = new Game('1', 'Дурак', 'Настольная игра', '100 руб.', 'Классическая русская карточная игра');
$a->view();

class ComputerGame extends Game
{
    private $requirements;
    private $age;

    public function __construct($id, $name, $type, $price, $description, $requirements, $age)
    {
        parent::__construct($id, $name, $type, $price, $description);
        $this->requirements = $requirements;
        $this->age = $age;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getRequirements()
    {
        return $this->requirements;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }

    public function view()
    {
        echo "<h1>" . $this->name . "</h1>" . "<p>" . $this->type . "<p>" . "<p>" . $this->requirements . "<p>";
    }

    public function save()
    {
        $id = $this->getId();
        $name = $this->getName();
        $type = $this->getType();
        $price = $this->getPrice();
        $description = $this->getDescription();
        $mysqli = new mysqli("localhost", "admin", "12345", "shop");
        $mysqli->query("INSERT INTO `PCGames`(`id`, `name`, `type`, `price`, `description`, `requirements`, `age`)
VALUES ('$id', '$name', '$type', '$price', '$description', '$this->requirements', '$this->age')");
    }
}

$b = new ComputerGame('2', 'Civilization', 'Стратегия', '999 руб', 'Изначально созданная легендарным дизайнером Сидом Мейером, Civilization представляет собой пошаговую стратегию, в которой игроку предлагается построить империю, способную выдержать испытание временем.', 'intel Core i3 2.5 Ghz or AMD Phenom II 2.6 Ghz or greater, 4 GB ОЗУ, 1 GB & AMD 5570 or nVidia 450', '12+');
$b->view();

//Задание 5
//class A
//{
//    public function foo()
//    {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//
//$a1 = new A(); //создаст экземпляр класса A и присваивает его переменной $a1
//$a2 = new A(); //создаст экземпляр класса A и присваивает его переменной $a2
//$a1->foo(); //вызовет метод foo() класса A который инкрементирует статическую переменную $x, выводит 1 и сохраняет данное значение для класса A и всех объектов данного класса
//$a2->foo(); //т. к. статические методы и свойства принадлежат классу а не объекту, то в статической переменной x сохраниться результат предыдущего вызова метода foo() и сохраниться 1, следовательно, он снова увеличит статическую переменную $x на 1 и выведет 2
//$a1->foo(); //увеличит переменную x на 1 и выведет 3
//$a2->foo(); //увеличит переменную x на 1 и выведет 4
//
//Задание 6
//class A
//{
//    public function foo()
//    {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//
//class B extends A
//{
//}
//
//$a1 = new A(); //создаст экземпляр класса A и присваивает его переменной $a1
//$b1 = new B(); //создаст экземпляр класса B и присваивает его переменной $b1
//$a1->foo(); //вызовет метод foo() класса A который инкрементирует статическую переменную $x, выводит 1 и сохраняет данное значение для класса A и всех объектов данного класса
//$b1->foo(); //вызовет метод foo() класса B который инкрементирует статическую переменную $x, выводит 1 и сохраняет данное значение для класса B и всех объектов данного класса
//$a1->foo(); //увеличит переменную x класса A на 1 и выведет 2
//$b1->foo(); //увеличит переменную x класса B на 1 и выведет 2
//
//Задание 7
//class A
//{
//    public function foo()
//    {
//        static $x = 0;
//        echo ++$x . "<br>";
//    }
//}
//
//class B extends A
//{
//}
//
//$a1 = new A; //так как объект не имеет свойств и мы не передаём никаких параметров то при инициализации можно не указывать скобки создаст экземпляр класса A и присваивает его переменной $a1
//$b1 = new B; //создаст экземпляр класса B и присваивает его переменной $b1
//$a1->foo(); //вызовет метод foo() класса A который инкрементирует статическую переменную $x, выводит 1 и сохраняет данное значение для класса A и всех объектов данного класса
//$b1->foo(); //вызовет метод foo() класса B который инкрементирует статическую переменную $x, выводит 1 и сохраняет данное значение для класса B и всех объектов данного класса
//$a1->foo(); //увеличит переменную x класса A на 1 и выведет 2
//$b1->foo(); //увеличит переменную x класса B на 1 и выведет 2