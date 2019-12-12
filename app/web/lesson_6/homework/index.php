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
if (!User::isGuest()) {
    User::trackingUserActions();
}

// Вызов Router
Router::run();

// Закрываем соединение с БД
Db::closeDbh();
