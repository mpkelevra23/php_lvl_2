<?php

/**
 * Class SiteController
 */
class SiteController extends BaseController
{

    /**
     * Action для главной страницы
     * @return bool
     */
    public function actionIndex()
    {
        // Получаем массив с товарами
        $goods = parent::getGoodsObj()->getGoodsList();

        // Подключаем вид
        require_once(ROOT . '/views/site/index.php');
        return true;
    }

    /**
     * Action для ошибочный запросов
     * @return mixed
     */
    public function actionError()
    {
        // Получаем адрес запроса
        $uri = trim(str_replace('lesson_5/homework', '', mb_strtolower($_SERVER['REQUEST_URI'])), '/');

        // Сообщение об ошибке
        $error = 'Страницы ' . $uri . ' не существует';

        // Выводим ошибку
        if (!empty($error)) {
            parent::showError($error);
        }
    }
}
