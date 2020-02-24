<?php

require_once 'Storage.php';

$status = Storage::getInstance()->get('user_locker');

// Если существует блокировка, то запрещаем пользователю действия на время её существования
while ($status) {
    echo "User is still locked, please wait...\n";
    sleep(1);
    $status = Storage::getInstance()->get('user_locker');
}
echo "User can work!\n";
