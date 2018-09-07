<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 12:43 PM
 */

class PhysicalProduct extends Product
{
    const INCOME = 5;
    private $count;

    public function __construct($id, $title, $price, $count)
    {
        parent::__construct($id, $title, $price);
        $this->count = $count;
        $this->countTotalPrice();
        $this->countProfit();
//        $this->createDP();
    }

    public function view()
    {
        echo "<div>
                <p>$this->title (штучный товар)</p>
                <p>Продано: $this->count шт</p>
                <p>Цена: $this->price руб/шт</p>
                <p>Итого: $this->totalPrice руб.</p>
                <p>Доход: $this->profit руб.</p>
            </div>";
    }

    protected function countTotalPrice()
    {
        $this->totalPrice = $this->count * $this->price;
    }

    public function countProfit()
    {
        $this->profit = $this->totalPrice * self::INCOME / 100;
    }

    public function createDP()
    {
//        $product = new Show();
//        $product->addProduct(new DigitalProduct($this->id, $this->title, $this->price, $this->count));
//        var_dump(new DigitalProduct($this->id, $this->title, $this->price, $this->count));
    }
}
