<?php

/**
 * Абстрактный класс BaseModel содержит общую логигу для моделей
 * Class BaseModel
 */
abstract class BaseModel
{
    // Database Handle
    private $dbh;

    /**
     * Подключаемся к БД
     * BaseModel constructor.
     */
    public function __construct()
    {
        $this->dbh = Db::getInstance();
    }

    /**
     * @return Db
     */
    protected function getDbh(): Db
    {
        return $this->dbh;
    }
}
