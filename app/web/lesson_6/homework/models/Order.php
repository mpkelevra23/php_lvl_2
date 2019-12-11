<?php

/**
 * Класс для работы с заказами
 * Class Order
 */
class Order extends BaseModel
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
        return parent::getDbh()->run('INSERT INTO lesson_6.order (id_user, created, total_price) VALUES  (:userId, :createdAt, :totalPrice)', [$userId, $createdAt, $totalPrice]);
    }

    /**
     * Получаем заказ
     * @param $orderId
     * @return mixed
     */
    public function getOrder($orderId)
    {
        return parent::getDbh()->run('SELECT lesson_6.order.id, lesson_6.order.id_order_status AS status_id, created, name AS status FROM lesson_6.order INNER JOIN lesson_6.order_status ON lesson_6.order.id_order_status = lesson_6.order_status.id WHERE lesson_6.order.id = :orderId', [$orderId])->fetch();
    }

    /**
     * Получаем список заказов (смотри вид order_list (подробнее в dump/view.sql))
     * @return array
     */
    public function getOrderList()
    {
        return parent::getDbh()->run('SELECT * FROM lesson_6.order_list')->fetchAll();
    }

    /**
     * Получаем список заказов пользователя
     * @param $userId
     * @return array
     */
    public function getUserOrderList($userId)
    {
        return parent::getDbh()->run('SELECT id, created FROM lesson_6.order WHERE id_user = :userId', [$userId])->fetchAll();
    }

    /**
     * Получаем полную информацию о заказе (смотри вид order_info (подробнее в dump/view.sql))
     * @param $orderId
     * @return array
     */
    public function getOrderInfo($orderId)
    {
        return parent::getDbh()->run('SELECT * FROM lesson_6.order_info WHERE order_id = :orderId', [$orderId])->fetchAll();
    }

    /**
     * Получаем список статусов
     * @return array
     */
    public function getOrderStatusList()
    {
        return parent::getDbh()->run('SELECT * FROM lesson_6.order_status;')->fetchAll();
    }

    /**
     * Изменяем статус заказа
     * @param $orderId
     * @param $statusId
     */
    public function updateOrderStatus($orderId, $statusId)
    {
        parent::getDbh()->run('UPDATE lesson_6.order SET id_order_status = :statusId WHERE id = :orderId', [$statusId, $orderId]);
    }
}
