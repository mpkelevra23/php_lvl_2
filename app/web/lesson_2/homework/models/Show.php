<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 1:11 PM
 */

class Show
{
    private $goods = [];

    public function show()
    {
        foreach ($this->goods as $value) {
            $value->view();
        }
    }

    public function addProduct(Products $value)
    {
        $this->goods[] = $value;
    }
}