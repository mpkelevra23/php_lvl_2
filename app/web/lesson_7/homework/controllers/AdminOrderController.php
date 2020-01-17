<?php

/**
 * Class AdminOrderController
 */
class AdminOrderController extends AdminBase
{
    /**
     * Список заказов
     * @return bool
     */
    public function actionIndex()
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Проверяем является ли пользователь администратором
            if (self::checkAdmin()) {

                // Список заказов
                $orderList = parent::getOrderObj()->getOrderList();

                if (!empty($orderList)) {
                    require_once(ROOT . '/views/admin/order/index.php');
                    return true;
                } else parent::showError('Список заказов пуст');
            } else parent::showError('Отказ в доступе');
        } else parent::showError('Необходимо войти на сайт');
    }


    public function actionUpdate($orderId)
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Проверяем является ли пользователь администратором
            if (self::checkAdmin()) {
                // Информация о заказе
                $order = parent::getOrderObj()->getOrder($orderId);

                if (!empty($order)) {
                    // Меняем статус заказа
                    if (isset($_POST['submit']) && !empty($_POST['status'])) {
                        // id статуса
                        $statusId = $_POST['status'];
                        // Меняем статус заказа
                        parent::getOrderObj()->updateOrderStatus($orderId, $statusId);

                        // Обновляем страницу
                        header("Location: /admin/order/update/$orderId");
                    }
                    // Список возможных статусов у заказа
                    $orderStatus = parent::getOrderObj()->getOrderStatusList();

                    require_once(ROOT . '/views/admin/order/update.php');
                    return true;
                } else parent::showError('Список заказов пуст');
            } else parent::showError('Отказ в доступе');
        } else parent::showError('Необходимо войти на сайт');
    }
}