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

            // Подключаем вид
            require_once(ROOT . '/views/cabinet/index.php');
        }
        return true;
    }
}
