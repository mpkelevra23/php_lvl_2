<?php

include_once 'Product.php';

$limit = 3;

//Если нажата кнопка 'ещё', то умножаем $limit на полученное значение
if (isset($_POST['more'])) {
    $limit *= $_POST['more'];
    $products = Product::getPictures($limit, 0);
    foreach ($products as $product) {
        echo '<p>' . $product['name'] . '</p>';
    }
} else { //Если кнопка 'ещё' не нажата, то выводим кол-во товаров указанный в $limit
    $products = Product::getPictures($limit, 0);
    foreach ($products as $product) {
        echo '<p>' . $product['name'] . '</p>';
    }
};
