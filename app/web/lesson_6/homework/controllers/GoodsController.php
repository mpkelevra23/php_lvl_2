<?php

/**
 * Class GoodsController
 */
class GoodsController extends BaseController
{
    /**
     * Просмотр одного товара
     * @param $id
     * @return bool
     */
    public function actionView($id)
    {
        // Получаем данные о товаре
        $goods = parent::getGoodsObj()->getGoodsById($id);

        if (!empty($goods)) {
            // Подключаем вид
            require_once(ROOT . '/views/goods/view.php');
            return true;
        } else {
            parent::showError('Такого товара не существует');
        }
    }
}
