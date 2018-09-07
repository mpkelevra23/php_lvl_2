<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 12:49 PM
 */

class WeightProduct extends Product
{
    const INCOME = 5;
    private $weight;

    public function __construct($id, $title, $price, $weight)
    {
        parent::__construct($id, $title, $price);
        $this->weight = $weight;
        $this->countTotalPrice();
        $this->countProfit();
    }

    public function view()
    {
        echo "<div>
                <p>$this->title (весовой товар)</p>
                <p>Продано: $this->weight кг</p>
                <p>Цена: $this->price руб/кг.</p>
                <p>Итого: $this->totalPrice руб.</p>
                <p>Доход: $this->profit руб.</p>
            </div>";
    }

    protected function countTotalPrice()
    {
        $this->totalPrice = $this->price * $this->weight;
    }

    public function countProfit()
    {
        $this->profit = $this->totalPrice * self::INCOME / 100;
    }
}