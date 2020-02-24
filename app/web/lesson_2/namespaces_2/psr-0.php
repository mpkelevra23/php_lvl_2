<?php

use vendor\lib_1\User;
use vendor\lib_1\vendor\admin\Login;

/*
 * Будет ошибка из-за стандарта PSR-0 (автозагрузчик не подключит необходимый файл)
 * Надо использовать автозагрузчик для стандарта PSR-4
 */

use controller\MyController;

// Автозагрузка файлов функцией __autoload, в данный момент не используется (выдаст ошибку __autoload() is deprecated, use spl_autoload_register() instead)
function __autoload($className)
{
    $className = str_replace('\\', '/', $className);
    require_once $className . '.php';
}


// Автозагрузка файлов функцией spl_autoload_register (передаём имя функции автозагрузки в spl_autoload_register)
function myAutoload($className)
{
    $className = str_replace('\\', '/', $className);
    require_once $className . '.php';
}

spl_autoload_register('myAutoload');

$user = new User();
echo $user->getId() . '<br>';

// Автозагрузка файлов функцией spl_autoload_register (создаём анонимную функцию с реализацией автозагрузки)
spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    require_once $className . '.php';
});

$user = new User();
echo $user->getId() . '<br>';

// Автозагрузчик отработает по стандарту PSR-0
$login = new Login();
echo $login->printInfo();

/*
 * Будет ошибка из-за стандарта PSR-0 (автозагрузчик не подключит необходимый файл)
 * Надо использовать автозагрузчик для стандарта PSR-4
 */
$controller = new MyController();
$controller->printInfo();