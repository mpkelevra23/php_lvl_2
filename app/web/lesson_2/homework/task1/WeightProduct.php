<?php

class WeightProduct extends PhysicalProduct
{
    private $weight;

    public function __construct(string $name, int $amount = 1, int $weight = 1)
    {
        parent::__construct($name, $amount);
        self::setWeight($weight);
    }

    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getTotalPrice()
    {
        return parent::getTotalPrice() * $this->getWeight();
    }

}