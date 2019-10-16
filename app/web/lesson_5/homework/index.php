<?php

// FRONT CONTROLLER

// Общие настройки
// Включаем отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Стартуем сессию
session_start();

// Подключение файлов системы
define('ROOT', dirname(__FILE__));
require_once ROOT . '/components/Autoload.php';

// Вызов Router
Router::run();
