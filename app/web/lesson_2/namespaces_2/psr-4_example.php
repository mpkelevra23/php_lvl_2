<?php

// Подключаем autoloader по стандарту psr-4.
require_once 'psr-4.php';

// Подключаем класс
use controller\MyController;

// Создаём объект psr-4 autoloader класс
$loader = new \Example\Psr4AutoloaderClass();

// Регистрируем класс в spl_autoload_register
$loader->register();

/*
 * Добавляем пространство имён,
 * путь должен идти от индексного файла проекта (index.php)
 * или непосредственно от того файла к которому будем обращаться (psr-4_example.php))
 */
$loader->addNamespace('controller', 'lesson_2/namespaces_2/vendor/lib_1/vendor/admin/controller');

// psr-4 autoloader подключит необходимый класс по стандарту psr-4
$controller = new MyController();
echo $controller->printInfo();
