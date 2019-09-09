<?php

abstract class Product
{
    const INCOME = 7;
    protected $name;
    protected $amount;

    public function __construct(string $name, int $amount = 1)
    {
        $this->name = $name;
        $this->amount = $amount;
    }

    abstract public function getTotalPrice();

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getProfit()
    {
        return $this->getTotalPrice() * self::INCOME / 100;
    }
}