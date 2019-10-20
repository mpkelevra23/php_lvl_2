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
    public static function getProducts(int $limit, int $offset): array
    {

        try {
            // Соединение с БД
            $dbh = new PDO('pgsql:host=localhost;port=5432;dbname=admin;', 'admin', '123456',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false, // Отключает эмуляцию
                ]
            );

            // Подготавливаем запрос (но он тут не актуален так как мы сами задаём эти данный в коде (не получая их от пользователя))
            $sth = $dbh->prepare("SELECT name FROM product LIMIT :limit OFFSET :offset");
            $sth->bindParam(':limit', $limit, PDO::PARAM_INT);
            $sth->bindParam(':offset', $offset, PDO::PARAM_INT);

            // Выполняем запрос к БД
            $sth->execute();
            // Сохраняем запрос в виде ассоциативного массива

            $result = $sth->fetchAll();

            // Закрываем соединение с БД
            $sth = null;
            $dbh = null;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        //Возвращаем рузультат
        return $result;
    }
}
