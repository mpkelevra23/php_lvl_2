<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 1:43 PM
 */

class A
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
}