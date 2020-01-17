<?php

/**
 * Class BasketController
 */
class BasketController extends BaseController
{
    /**
     * Список товаров в корзине
     * @return bool
     */
    public function actionIndex()
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {

            // Получаем id пользователя
            $userId = User::getUserId();

            // Информация о товарах
            $goods = parent::getBasketObj()->getGoodsFromBasket($userId);

            // Общая стоймость товаров в корзине
            $totalPrice = parent::getBasketObj()->getTotalPrice($userId);

            // Подключаем вид
            require_once(ROOT . '/views/basket/index.php');
            return true;
        } else parent::showError('Необходимо войти на сайт');
    }

    /**
     * Добавляем товар в корзину
     * @param $goodsId
     */
    public function actionAdd($goodsId)
    {
        // Проверяем является ли пользователь гостем
        if (!User::isGuest()) {

            // Получаем id пользователя
            $userId = User::getUserId();

            // Если данного товара нет в корзине, то добавляем его
            if (!parent::getBasketObj()->checkGoodsExistsInBasket($goodsId, $userId)) {

                // Получаем цену товара
                $goods = parent::getGoodsObj()->getGoodsById($goodsId);
                $price = $goods['price'];

                // Добавляем товар в корзину
                parent::getBasketObj()->addGoodsInBasket($userId, $goodsId, $price);

                // Возвращаем пользователя на страницу
                $referrer = $_SERVER['HTTP_REFERER'];
                header("Location: $referrer");
            } else {
                parent::showError('Данные товар уже добавлен в корзину');
            }
        } else {
            parent::showError('Необходимо войти на сайт');
        }
    }
}
