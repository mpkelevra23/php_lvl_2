<?php

/**
 * Component для контроля вывода
 * Class Templater
 */
class Templater
{
    public static function viewInclude($file, $params = [])
    {
        // Установка переменных для шаблона.
        foreach ($params as $key => $value) {
            $$key = $value;
        }

        // Генерация HTML в строку.
        ob_start();
        require_once $file;
        return ob_get_clean();
    }
}
