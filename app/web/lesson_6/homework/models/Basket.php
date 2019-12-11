<?php

/**
 * Класс для работы с корзиной пользователя
 * Class Basket
 */
class Basket extends BaseModel
{
    /**
     * Добавляем товар в корзину пользователя
     * @param $userId
     * @param $goodsId
     * @param $price
     * @return bool|false|PDOStatement
     */
    public function addGoodsInBasket($userId, $goodsId, $price)
    {
        return parent::getDbh()->run('INSERT INTO lesson_6.basket (id_user, id_good, price) VALUES (:userId, :goodsId, :price)', [$userId, $goodsId, $price]);
    }

    /**
     * Получаем товары из корзины
     * @param $userId
     * @return array
     */
    public function getGoodsFromBasket($userId)
    {
        return parent::getDbh()->run('SELECT * FROM lesson_6.basket INNER JOIN lesson_6.goods ON basket.id_good = goods.id WHERE id_user = :id_user AND is_in_order = false', [$userId])->fetchAll();
    }

    /**
     * Проверяем существует ли товар в корзине
     * @param $goodsId
     * @param $userId
     * @return mixed
     */
    public function checkGoodsExistsInBasket($goodsId, $userId)
    {
        return parent::getDbh()->run('SELECT count(id) FROM lesson_6.basket WHERE id_good = :id_good AND id_user = :id_user AND is_in_order = false', [$goodsId, $userId])->fetchColumn();
    }

    /**
     * Получаем финальную стоимость товаров
     * @param $userId
     * @return mixed
     */
    public function getTotalPrice($userId)
    {
        return parent::getDbh()->run('SELECT SUM(price) FROM lesson_6.basket WHERE id_user = :id_user AND is_in_order = false', [$userId])->fetch();
    }

    /**
     * Проверка на существование не заказанных товаров в корзине
     * @param $userId
     * @return mixed
     */
    public function checkBasketEmpty($userId)
    {
        return parent::getDbh()->run('SELECT count(id) FROM lesson_6.basket WHERE id_user = :id_user AND is_in_order = false', [$userId])->fetchColumn();
    }
}
