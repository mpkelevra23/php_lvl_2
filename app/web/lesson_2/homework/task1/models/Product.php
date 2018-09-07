<?php

/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 12:40 PM
 */
abstract class Product
{
    protected $id;
    protected $title;
    protected $price;
    protected $profit;
    protected $totalPrice;

    public function __construct($id, $title, $price)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
    }

    abstract protected function countTotalPrice();

    abstract public function view();

    abstract public function countProfit();
}