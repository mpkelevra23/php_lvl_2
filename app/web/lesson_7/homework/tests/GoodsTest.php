<?php

// Подключаем автозагрузку классов
require_once '/var/www/php_lvl_2.local/app/web/lesson_7/homework/components/Autoload.php';

use PHPUnit\Framework\TestCase;

class GoodsTest extends TestCase
{
    protected static $dbh;
    protected $fixture;

    public function setUp(): void
    {
        $this->fixture = new Goods();
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
    }

    public static function tearDownAfterClass(): void
    {
        self::$dbh = null;
    }

    /**
     * @covers Goods::addNewGood
     * @return mixed
     */
    public function testAddNewGood()
    {
        self::assertNotEmpty($this->fixture->addNewGood('test', 123456, 1, '/upload/img', '/upload/thumb', true, 'qwerty'));
        return self::$dbh->lastInsertId('admin.lesson_7.goods_id_seq');
    }

    /**
     * @depends testAddNewGood
     * @covers  Goods::getGoodsList
     */
    public function testGetGoodsList()
    {
        self::assertIsArray($this->fixture->getGoodsList());
        self::assertNotEmpty($this->fixture->getGoodsList());
    }

    /**
     * @depends testAddNewGood
     * @covers  Goods::getAllGoodsList
     */
    public function testGetAllGoodsList()
    {
        self::assertIsArray($this->fixture->getAllGoodsList());
        self::assertNotEmpty($this->fixture->getAllGoodsList());
    }

    /**
     * @param $goodsId
     * @covers  Goods::getGoodById
     * @depends testAddNewGood
     */
    public function testGetGoodById($goodsId)
    {
        self::assertIsArray($this->fixture->getGoodById($goodsId));
        self::assertNotEmpty($this->fixture->getGoodById($goodsId));
    }

    /**
     * @param $goodId
     * @depends testAddNewGood
     * @covers  Goods::updateGood
     */
    public function testUpdateGood($goodId)
    {
        self::assertSame(1, $this->fixture->updateGood($goodId, 'qwerty', 654321, 1, true, 'qwerty', '/upload/img', '/upload/thumb'));
    }

    /**
     * @covers Goods::getCategoryList
     */
    public function testGetCategoryList()
    {
        self::assertIsArray($this->fixture->getCategoryList());
        self::assertNotEmpty($this->fixture->getCategoryList());
    }

    /**
     * @param $goodsId
     * @covers  Goods::deleteGood
     * @depends testAddNewGood
     */
    public function testDeleteGood($goodsId)
    {
        self::assertSame(1, $this->fixture->deleteGood($goodsId));
    }

    /**
     * @param $price
     * @covers Goods::checkPrice
     * @testWith [100.00]
     */
    public function testCheckPrice($price)
    {
        self::assertTrue($this->fixture->checkPrice($price));
    }

    /**
     * @depends testAddNewGood
     * @covers  Goods::checkGoodExists
     */
    public function testCheckGoodExists()
    {
        self::assertTrue($this->fixture->checkGoodExists('test'));
    }
}
