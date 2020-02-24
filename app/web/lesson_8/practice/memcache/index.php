<?php
// Пример Memcache
$memcache = new Memcache;
$memcache->connect('localhost', 11211) or die ("Не могу подключиться");

$version = $memcache->getVersion();
echo "Версия сервера: " . $version . "\n";

$tmp_object = new stdClass;
$tmp_object->str_attr = 'test';
$tmp_object->int_attr = 123;

$memcache->set('key', $tmp_object, false, 10) or die ("Ошибка при сохранении данных на сервере");
echo "Данные сохранены в кеше. (время жизни данных 10 секунд)\n";

$get_result = $memcache->get('key');
echo "Данные из кеша:\n";

var_dump($get_result);

// Пример Memcached
$m = new Memcached;
$m->addServer('localhost', 11211);
$items = array(
    'key1' => 'value1',
    'key2' => 'value2',
    'key3' => 'value3'
);
$m->setMulti($items);
$m->getDelayed(array('key1', 'key3'), true, 'result_cb');

function result_cb($memc, $item)
{
    var_dump($item);
}