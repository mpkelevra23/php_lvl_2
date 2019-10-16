<?php

/**
 * Class Db
 * Компонент для работы с базой данных
 */
class Db
{
    /**
     * Устанавливает соединение с базой данных
     * @return PDO
     */
    public static function getConnection()
    {
        // Подключаем конфигурациооный файл
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include($paramsPath);

        // Создаём объект класса PDO
        $dsn = "{$params['dbms']}:host={$params['host']};port={$params['port']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return $db;
    }
}
