<?php

define('ROOT', '/var/www/php_lvl_2.local/app/web/lesson_7/homework');

spl_autoload_register(function ($class_name) {
    $array_paths = [
        '/models/',
        '/components/',
        '/controllers/'
    ];

    foreach ($array_paths as $path) {
        $file = ROOT . $path . $class_name . '.php';
        if (is_file($file)) {
            include_once $file;
        }
    }
});
