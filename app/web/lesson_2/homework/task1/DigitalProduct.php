<?php


class DigitalProduct extends Product
{
    const PRICE = 100;

    public function __construct(string $name, int $amount = 1)
    {
        parent::__construct($name, $amount);
    }

    public function getTotalPrice()
    {
        return self::PRICE * $this->amount;
    }
}