<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 8/27/18
 * Time: 12:35 PM
 */
function __autoload($classname)
{
    include 'models/' . $classname . '.php';
}

$product = new Show();
$product->addProduct(new PhysicalProduct(1, "Товар 1", 100, 3));
$product->addProduct(new WeightProduct(3, "Товар 2", 70, 7));
$product->addProduct(new WeightProduct(4, "Товар 3", 100, 12));
$product->addProduct(new WeightProduct(5, "Товар 4", 120, 30));
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php $product->show(); ?></body>
</html>