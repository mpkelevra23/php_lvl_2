<?php

// FRONT CONTROLLER

// Общие настройки
// Включаем отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once ROOT . '/components/Autoload.php';

// Стартуем сессию
session_start();

// Отслеживаем действия пользователя
if (!User::isGuest()){
    User::trackingUserActions();
}

// Вызов Router
try {
    Router::run();
} catch (Exception $exception) {
    echo "<p>Ошибка! " . $exception->getMessage() .
        "<br>В строке " . $exception->getLine() .
        "<br>Файла " . $exception->getFile() . "</p>";
    die();
}
