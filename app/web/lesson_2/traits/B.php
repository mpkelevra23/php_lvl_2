<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 2:24 PM
 */

include 'my_trait.php';

class B
{
    use MyTrait;
}

$b = new B();
$b->setName('name class B');
echo $b->getName();
echo $b->view();