<?php

/**
 * Класс для работы с личным кабинетом пользователя
 * Class CabinetController
 */
class CabinetController extends BaseController
{
    /**
     * Вход в личный кабинет
     * @return bool
     */
    public function actionIndex()
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {

            // Получаем id пользователя
            $userId = User::getUserId();

            // Получаем данные о пользователе из бд
            $user = parent::getUserObj()->getUserById($userId);

            // Получаем 5 последних адресов, на которых был пользователь
            if (isset($_SESSION['last_actions']) && is_array($_SESSION['last_actions'])) {
                $last_actions = array_slice($_SESSION['last_actions'], -5, 5);
                // Подключаем вид
                require_once(ROOT . '/views/cabinet/index.php');
                return true;
            }
        } else {
            parent::showError('Необходимо войти на сайт');
        }
    }
}
