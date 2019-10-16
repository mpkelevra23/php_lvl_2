<?php

include_once 'Singleton.php';

/**
 * Class Db
 * Класс для работы с базой данных
 */
class Db
{

    use Singleton;

    /**
     * Устанавливает соединение с базой данных
     * @return PDO
     */
    public function getConnection(): PDO
    {

        try {
            $dbh = new PDO('mysql:host=localhost;dbname=geekbrains;charset=utf8', 'admin', '123456');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    public function closeConnection(PDO $PDO)
    {
        return $PDO = null;
    }
}