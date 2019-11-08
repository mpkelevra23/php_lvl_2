<?php

/**
 * Class Db
 * Компонент для работы с базой данных
 */
class Db
{
    // Переменная для хранения экземпляра класса
    private static $instance;

    // Переменная для хранения экземпляра PDO
    private $pdo;

    /**
     * Db constructor.
     * При создании объекта класса Db создаём объект класса PDO
     */
    public function __construct()
    {
        // Подключаем конфигурациооный файл
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include_once($paramsPath);

        // Создаём объект класса PDO
        $dsn = "{$params['dbms']}:host={$params['host']};port={$params['port']};dbname={$params['dbname']}";
        $this->pdo = new PDO($dsn, $params['user'], $params['password'], [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    /**
     * Метод проверки существования объекта класса Db, и для доступа к свойствам и методам класса Db
     * @return Db
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Вызов методов класса PDO
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->pdo, $method], $args);
    }

    /**
     * Выполнение запроса
     * @param $sql
     * @param array $args
     * @return bool|false|PDOStatement
     */
    public function run($sql, $args = [])
    {
        if (!$args) {
            return $this->pdo->query($sql);
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }
}
