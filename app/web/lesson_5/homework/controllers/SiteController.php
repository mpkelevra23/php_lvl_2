<?php

/**
 * Class SiteController
 */
class SiteController
{
    /**
     * Action для главной страницы
     * @return bool
     */
    public function actionIndex()
    {
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

        // Подключаем вид
        require_once(ROOT . '/views/site/error.php');

        return true;
    }
}
