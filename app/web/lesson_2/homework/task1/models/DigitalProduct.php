<?php

/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 12:47 PM
 */
class DigitalProduct extends PhysicalProduct

{
    private $count;

    public function __construct($id, $title, $price, $count)
    {
        parent::__construct($id, $title);
        $this->price = $price / 2;
        $this->count = $count;
        $this->countTotalPrice();
    }

    public function view()
    {
        echo "<div>
                <p>$this->title (штучный товар)</p>
                <p>Продано: $this->count шт</p>
                <p>Цена: $this->price руб/шт</p>
                <p>Итого: $this->totalPrice руб.</p>
            </div>";
    }

    protected function countTotalPrice()
    {
        $this->totalPrice = $this->price * $this->count;
    }

    public function countProfit()
    {
        $this->profit = $this->totalPrice * self::INCOME / 100;
    }
}