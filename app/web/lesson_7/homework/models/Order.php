<?php

/**
 * Model для работы с заказами
 * Class Order
 */
class Order
{
    /**
     * При добавление заказа срабатывает триггер в БД, который вставляет id нового заказа в таблицу basket
     * и меняет is_in_order с false на true (подробнее в dump/trigger.sql)
     * @param $userId
     * @param $createdAt
     * @param $totalPrice
     * @return bool|false|PDOStatement
     */
    public function addOrder($userId, $createdAt, $totalPrice)
    {
        return Db::getInstance()->run(
            'INSERT INTO lesson_7.order (id_user, created, total_price) VALUES  (:userId, :createdAt, :totalPrice)',
            [$userId, $createdAt, $totalPrice]
        );
    }

    /**
     * Получаем заказ
     * @param $orderId
     * @return mixed
     */
    public function getOrder($orderId)
    {
        return Db::getInstance()->run(
            'SELECT lesson_7.order.id, lesson_7.order.id_order_status AS status_id, created, name AS status FROM lesson_7.order INNER JOIN lesson_7.order_status ON lesson_7.order.id_order_status = lesson_7.order_status.id WHERE lesson_7.order.id = :orderId',
            [$orderId]
        )->fetch();
    }

    /**
     * Получаем список заказов (смотри вид order_list (подробнее в dump/view.sql))
     * @return array
     */
    public function getOrderList()
    {
        return Db::getInstance()->run('SELECT * FROM lesson_7.order_list')->fetchAll();
    }

    /**
     * Получаем полный список заказов пользователя, сортируем по дате заказа
     * @param $userId
     * @return array
     */
    public function getUserOrderList($userId)
    {
        return Db::getInstance()->run(
            'SELECT id, created, status_id, status FROM lesson_7.order_list WHERE user_id = :userId ORDER BY created DESC',
            [$userId]
        )->fetchAll();
    }

    /**
     * Получаем 5 последних заказов пользователя, сортируем по дате заказа
     * @param $userId
     * @return array
     */
    public function getLastUserOrders($userId)
    {
        return Db::getInstance()->run(
            'SELECT id, created, status_id, status FROM lesson_7.order_list WHERE user_id = :userId ORDER BY created DESC LIMIT 5',
            [$userId]
        )->fetchAll();
    }

    /**
     * Получаем полную информацию о заказе (смотри вид order_info (подробнее в dump/view.sql))
     * @param $userId
     * @param $orderId
     * @return array
     */
    public function getOrderInfo($userId, $orderId)
    {
        return Db::getInstance()->run(
            'SELECT * FROM lesson_7.order_info WHERE user_id = :userId AND order_id = :orderId',
            [$userId, $orderId]
        )->fetchAll();
    }

    /**
     * Получаем список статусов
     * @return array
     */
    public function getOrderStatusList()
    {
        return Db::getInstance()->run('SELECT * FROM lesson_7.order_status;')->fetchAll();
    }

    /**
     * Изменяем статус заказа
     * @param $orderId
     * @param $statusId
     * @return bool|false|PDOStatement
     */
    public function updateOrderStatus($orderId, $statusId)
    {
        return Db::getInstance()->run(
            'UPDATE lesson_7.order SET id_order_status = :statusId WHERE id = :orderId',
            [$statusId, $orderId]
        )->rowCount();
    }

    /**
     * Удаляем заказ
     * @param $orderId
     * @return bool|false|PDOStatement
     */
    public function deleteOrder($orderId)
    {
        return Db::getInstance()->run('DELETE FROM lesson_7.order WHERE id = :id', [$orderId])->rowCount();
    }
}
