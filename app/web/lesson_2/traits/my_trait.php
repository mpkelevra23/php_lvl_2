<?php

/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/26/18
 * Time: 2:19 PM
 */
trait MyTrait
{
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        return $this->name = $name;
    }

    public function view()
    {
        return "<p>$this->name</p>";
    }
}