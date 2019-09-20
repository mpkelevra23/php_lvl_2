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

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=geekbrains;charset=utf8', 'admin', '123456');
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $dbh;
    }

    /**
     * Закрываем соединение с базой данных
     * @param PDO $PDO
     * @return null
     */
    public static function closeConnection(PDO $PDO)
    {
       return $PDO = null;
    }
}