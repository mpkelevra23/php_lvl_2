<?php

abstract class Product
{
    const INCOME = 7;
    protected $name;
    protected $amount;

    public function __construct(string $name, int $amount = 1)
    {
        self::setName($name);
        self::setAmount($amount);
    }

    abstract public function getTotalPrice(): int;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): string
    {
        return $this->name = $name;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): int
    {
        return $this->amount = $amount;
    }

    public function getProfit(): int
    {
        return static::getTotalPrice() * self::INCOME / 100;
    }
}