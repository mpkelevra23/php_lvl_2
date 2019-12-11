<?php

/**
 * Class Goods
 * Класс для работы с товаром
 */
class Goods extends BaseModel
{
    /**
     * Получаем массив товаров со статусом = 1
     * @return array
     */
    public function getGoodsList()
    {
        return parent::getDbh()->run('SELECT id, name, price FROM lesson_6.goods WHERE status = 1')->fetchAll();
    }

    /**
     * Получаем товар по id
     * @param $goodId
     * @return mixed
     */
    public function getGoodsById($goodId)
    {
        return parent::getDbh()->run('SELECT * FROM lesson_6.goods WHERE status = 1 AND id = :id', [$goodId])->fetch();
    }
}
