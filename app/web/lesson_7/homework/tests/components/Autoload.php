<?php

spl_autoload_register(function ($class_name) {
    $array_paths = [
        '/var/www/php_lvl_2.local/app/web/lesson_7/homework/models/',
        '/var/www/php_lvl_2.local/app/web/lesson_7/homework/components/',
        '/var/www/php_lvl_2.local/app/web/lesson_7/homework/controllers/'
    ];

    foreach ($array_paths as $path) {
        $file = $path . $class_name . '.php';
        if (is_file($file)) {
            include_once $file;
        }
    }
});
