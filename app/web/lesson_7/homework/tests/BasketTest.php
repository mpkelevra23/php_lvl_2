<?php

// Подключаем автозагрузку классов
require_once '/var/www/php_lvl_2.local/app/web/lesson_7/homework/components/Autoload.php';

use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
    protected static $dbh;
    protected $fixture;

    public function setUp(): void
    {
        $this->fixture = new Basket();
    }

    protected function tearDown(): void
    {
        $this->fixture = null;
    }

    /*
     * Создаю и удаляю записи в БД для работы тесто (ничего умнее не придумал)
     */
    public static function setUpBeforeClass(): void
    {
        self::$dbh = Db::getInstance();
        self::$dbh->run("INSERT INTO lesson_7.users(id, name, email, password) VALUES (1, 'test', 'test@test.com', 123456)");
        self::$dbh->run("INSERT INTO lesson_7.goods(id, name, price, id_category, img_address, img_thumb_address, status, description) VALUES (1, 'test', 123456, 1, '/upload/img', '/upload/thumb', true, 'qwerty')");
    }

    public static function tearDownAfterClass(): void
    {
        self::$dbh->run("DELETE FROM lesson_7.goods WHERE id = 1");
        self::$dbh->run("DELETE FROM lesson_7.users WHERE id = 1");
        self::$dbh = null;
    }

    /**
     * @param $userId
     * @param $goodsId
     * @param $price
     * @return mixed
     * @covers       Basket::addGoodsInBasket
     * @testWith [1, 1, 123456]
     */
    public function testAddGoodsInBasket($userId, $goodsId, $price)
    {
        self::assertInstanceOf(PDOStatement::class, $this->fixture->addGoodsInBasket($userId, $goodsId, $price));
        return self::$dbh->lastInsertId('admin.lesson_7.basket_id_seq');
    }

    /**
     * @param $userId
     * @depends      testAddGoodsInBasket
     * @covers       Basket::getGoodsFromBasket
     * @testWith [1]
     */
    public function testGetGoodsFromBasket($userId)
    {
        self::assertIsArray($this->fixture->getGoodsFromBasket($userId));
        self::assertNotEmpty($this->fixture->getGoodsFromBasket($userId));
    }

    /**
     * @param $userId
     * @depends testAddGoodsInBasket
     * @covers  Basket::getTotalPrice
     * @testWith [1]
     */
    public function testGetTotalPrice($userId)
    {
        self::assertNotEmpty($this->fixture->getTotalPrice($userId));
    }

    /**
     * @param $goodId
     * @param $userId
     * @depends testAddGoodsInBasket
     * @covers  Basket::checkGoodsExistsInBasket
     * @testWith [1, 1]
     */
    public function testCheckGoodsExistsInBasket($goodId, $userId)
    {
        self::assertIsInt($this->fixture->checkGoodsExistsInBasket($goodId, $userId));
        self::assertNotEmpty($this->fixture->checkGoodsExistsInBasket($goodId, $userId));

    }

    /**
     * @param $userId
     * @depends testAddGoodsInBasket
     * @covers  Basket::checkBasketEmpty
     * @testWith [1]
     */
    public function testCheckBasketEmpty($userId)
    {
        self::assertIsInt($this->fixture->checkBasketEmpty($userId));
        self::assertNotEmpty($this->fixture->checkBasketEmpty($userId));
    }

    /**
     * @param $basketId
     * @covers  Basket::deleteFromBasket
     * @depends testAddGoodsInBasket
     */
    public function testDeleteFromBasket($basketId)
    {
        var_dump($basketId);
        self::assertSame(1, $this->fixture->deleteFromBasket(1, $basketId));
    }
}
