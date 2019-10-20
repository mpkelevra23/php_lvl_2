<?php

/**
 * Класс для работы с личным кабинетом пользователя
 * Class CabinetController
 */

class CabinetController
{
    /**
     * Вход в личный кабинет
     * @return bool
     */
    public function actionIndex()
    {
        // Если пользователь не вошёл в систему, отправляем его на главную страницу
        if (User::isGuest()) {
            header("Location: /index/");
        } else {

            // Получаем id пользователя из сессии
            $userId = $_SESSION['user'];

            // Получаем данные о пользователе из бд
            $user = User::getUserById($userId);

            // Получаем 5 последних адресов, на которых был пользователь
            if (isset($_SESSION['last_actions']) && is_array($_SESSION['last_actions'])) {
                $last_actions = array_slice($_SESSION['last_actions'], -5, 5);
            }

            // Подключаем вид
            require_once(ROOT . '/views/cabinet/index.php');
        }
        return true;
    }
}
