<?php

spl_autoload_register(function ($class) {
    include $class . '.php';
});

$products[] = new DigitalProduct('Цифровой товар', 5);
$products[] = new PhysicalProduct('Физический товар', 7);
$products[] = new WeightProduct('Весовой товар', 10, 15);

foreach ($products as $product) {
    echo $product->getName() . ' имеет окончательную стоймость ' . $product->getTotalPrice() . ' руб. и доход в размере ' . $product->getProfit() . ' руб.<br>';
}