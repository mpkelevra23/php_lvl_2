<?php

/**
 * Class OrderController
 */
class OrderController extends BaseController
{
    /**
     * Создаём заказ
     * @return bool
     */
    public function actionCreate()
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {

            // Получаем id пользователя
            $userId = User::getUserId();

            // Проверяем есть ли товар в корзине
            if (parent::getBasketObj()->checkBasketEmpty($userId)) {

                // Дата создания
                $createdAt = date("Y-m-d H:i:s");

                // Общая стоймость товаров в корзине
                $totalPrice = parent::getBasketObj()->getTotalPrice($userId);

                // Создаём заказ
                parent::getOrderObj()->addOrder($userId, $createdAt, $totalPrice['sum']);

                require_once(ROOT . '/views/order/create.php');
                return true;
            } else {
                parent::showError('Корзина пуста');
            }
        } else {
            parent::showError('Необходимо войти на сайт');
        }
    }

    /**
     * Выводим список заказов
     * @return bool
     */
    public function actionList()
    {
        if (!User::isGuest()) {

            // Получаем id пользователя
            $userId = User::getUserId();

            // Список заказов
            $orders = parent::getOrderObj()->getUserOrderList($userId);

            if (!empty($orders)) {
                // Подключаем вид
                require_once(ROOT . '/views/order/list.php');
                return true;
            } else {
                parent::showError('Заказов нет');
            }
        } else {
            parent::showError('Надо войти в систему');
        }
    }

    /**
     * Просмотр заказа
     * @param $orderId
     * @return bool
     */
    public function actionView($orderId)
    {
        if (!User::isGuest()) {

            // Получаем полную информацию о заказе
            $orders = parent::getOrderObj()->getOrderInfo($orderId);

            if (!empty($orders)) {
                // Дата и время заказа.
                $created = $orders[0]['created'];
                // Подключаем вид
                require_once(ROOT . '/views/order/view.php');
                return true;
            } else {
                parent::showError('Такого заказа не существует');
            }
        } else {
            parent::showError('Необходимо войти на сайт');
        }
    }
}
