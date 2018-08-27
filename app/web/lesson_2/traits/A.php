<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 2:21 PM
 */

include 'my_trait.php';

class A
{
    private $name = "name class A";
    use MyTrait;
}

$a = new A();
echo $a->view();
$a->setName('new name class A');
echo $a->getName();