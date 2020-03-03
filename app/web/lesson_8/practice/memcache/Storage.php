<?php

/**
 * Class Storage
 * Класс для хранения значений в Memcached
 */
final class Storage
{
    // Переменная для хранения экземпляра класса
    private const PREFIX = 'project:';

    // Переменная для хранения класса Memcached
    private static $instance;

    // Префикс для записей в Memcached (для того, чтобы отличить одни записи от других (Memcached на сервере един))
    private $cache;

    /**
     * Storage constructor.
     */
    private function __construct()
    {
        $this->cache = new Memcached();
        $this->cache->addServer('localhost', 11211);
    }

    /**
     * @return Storage
     */
    public static function getInstance(): Storage
    {
        return self::$instance ?? (self::$instance = new self());
    }

    /**
     * @param $key
     * @param $value
     * @return bool
     */
    public function set($key, $value)
    {
        try {
            return $this->cache->set(self::PREFIX . $key, $value);
        } catch (MemcachedException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        try {
            return $this->cache->get(self::PREFIX . $key);
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $key
     * @return bool
     */
    public function delete($key)
    {
        try {
            return $this->cache->delete(self::PREFIX . $key);
        } catch (MemcachedException $exception) {
            echo $exception->getMessage();
        }
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    private function __sleep()
    {
    }
}