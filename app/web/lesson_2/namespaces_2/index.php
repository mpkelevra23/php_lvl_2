<?php

use vendor\lib_1\User;
use vendor\lib_2\User as MyUser;

require_once 'vendor/lib_1/User.php';
require_once 'vendor/lib_2/User.php';

// 1-ый способ, используем ключевое слово use
$user = new User();

echo $user->getId() . '<br>';

// 2-ой способ, прописываем имя класса с пространством имён
$user = new \vendor\lib_2\User();

echo $user->getId() . '<br>';

// 3-ий способ, используем ключевое слово use с as
$user = new MyUser();

echo $user->getId() . '<br>';

// Обращение к функции в файле с пространством имён
echo vendor\lib_1\infoUser() . '<br>';
