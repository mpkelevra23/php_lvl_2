<?php

/**
 * Класс для работы с товарами
 * Class Product
 */
class Product
{
    /**
     * Возвращаем массив товаров
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public static function getPictures(int $limit, int $offset): array
    {

        try {
            // Соединение с БД
            $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=admin;', 'admin', '123456');
            // Формируем запрос
            $sql = "SELECT name FROM product LIMIT $limit OFFSET $offset";
            // Подготавливаем запрос
            $sth = $dbh->prepare($sql);
            // Выполняем запрос к БД
            $sth->execute();
            $result = $sth->fetchAll();
            // Закрываем соединение с БД
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Возвращаем рузультат
        return $result;
    }
}