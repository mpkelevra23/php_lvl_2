<?php

/**
 * Controller для работы с сайтом
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
        //Титул страницы
        $title = 'Главная';

        // Получаем массив с товарами
        $goods = self::getGoodsObj()->getGoodsList();

        // Выводим
        echo Templater::viewInclude(ROOT . '/views/site/index.php',
            [
                'title' => $title,
                'goods' => $goods
            ]
        );
        return true;
    }

    /**
     * Action для ошибочный запросов
     * @return bool|void
     */
    public function actionError()
    {
        // Получаем адрес запроса
        $uri = trim(str_replace('lesson_7/homework', '', mb_strtolower($_SERVER['REQUEST_URI'])), '/');

        // Сообщение об ошибке
        $error = 'Страницы ' . $uri . ' не существует';

        // Выводим ошибку
        if (!empty($error)) {
            return self::showError($error);
        }
        return false;
    }
}
