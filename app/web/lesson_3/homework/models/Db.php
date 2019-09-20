<?php

/**
 * Class Db
 * Класс для работы с базой данных
 */
class Db
{
    /**
     * Устанавливает соединение с базой данных
     * @return PDO
     */
    public static function getConnection()
    {
        $dsn = "mysql:host=localhost;dbname=geekbrains;charset=utf8";
        $db = new PDO($dsn, 'admin', '123456');

        return $db;
    }
}