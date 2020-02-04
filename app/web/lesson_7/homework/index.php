<?php

// FRONT CONTROLLER

// Общие настройки
// Включаем отображение ошибок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Подключаем автозагрузку классов
require_once 'components/Autoload.php';

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
