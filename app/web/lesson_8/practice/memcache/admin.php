<?php

ini_set('display_errors', 'on');

require_once 'Storage.php';

// Ключ для блокировки (locker)
$command = 'user_locker';

// На время выполнения логики приложения, устанавливаем блокировку
Storage::getInstance()->set($command, true);
echo "Start locking...\n";

sleep(10); // Логика приложения

echo "User unlocked...\n";

// После выполнения логики приложения удаляем блокировку
Storage::getInstance()->delete($command);