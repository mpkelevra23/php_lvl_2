<?php

/**
 * Класс для работы с личным кабинетом пользователя
 * Class CabinetController
 */

class CabinetController
{
    // Объект класса User
    private $user;

    /**
     * Создаём объект класса User
     * CabinetController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Вход в личный кабинет
     * @return bool
     */
    public function actionIndex()
    {
        // Если пользователь не вошёл в систему, отправляем его на главную страницу
        if ($this->user->isGuest()) {
            header("Location: /index/");
        } else {

            // Получаем id пользователя из сессии
            $userId = $_SESSION['user'];

            // Получаем данные о пользователе из бд
            $user = $this->user->getUserById($userId);

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
