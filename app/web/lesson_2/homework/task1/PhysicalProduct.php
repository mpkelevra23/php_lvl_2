<?php


class PhysicalProduct extends DigitalProduct
{

    public function __construct(string $name, int $amount = 1)
    {
        parent::__construct($name, $amount);
    }

    public function getTotalPrice()
    {
        return parent::getTotalPrice() * 2;
    }
}