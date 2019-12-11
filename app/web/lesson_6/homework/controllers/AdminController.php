<?php

/**
 * Class AdminController
 */
class AdminController extends AdminBase
{
    /**
     * Action для стартовой страницы "Панель администратора"
     * @return bool
     */
    public function actionIndex()
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {
            // Проверяем является ли пользователь администратором
            if (self::checkAdmin()) {
                require_once(ROOT . '/views/admin/index.php');
                return true;
            } else parent::showError('Отказ в доступе');
        } else parent::showError('Необходимо войти на сайт');
    }
}
