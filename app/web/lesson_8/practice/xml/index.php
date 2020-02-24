<?php
// Преобразуеь правильно сформированный XML-документ в объект класса SimpleXMLElement.
$movies = simplexml_load_file('/var/www/php_lvl_2.local/app/web/lesson_8/practice/xml/info.xml');

// Убери комментарий в нужном тебе примере

// Получение части документа <plot>
//echo $movies->movie[0]->plot, PHP_EOL;

// Получение строки <line>
//echo $movies->movie->{'great-lines'}->line, PHP_EOL;

// Доступ к неуникальным элементам в SimpleXML
// Для каждого узла <character>, мы отдельно выведем имя <name>.
//foreach ($movies->movie->characters->character as $character) {
//    echo $character->name, ' играет ', $character->actor, PHP_EOL;
//}

// Использование атрибутов
/* Доступ к узлу <rating> первого фильма.
 * Так же выведем шкалу оценок. */
//foreach ($movies->movie[0]->rating as $rating) {
//    switch((string) $rating['type']) { // Получение атрибутов элемента по индексу
//        case 'thumbs':
//            echo $rating, ' thumbs up ';
//            break;
//        case 'stars':
//            echo $rating, ' stars ';
//            break;
//    }
//}

// Сравнение элементов и атрибутов с текстом
// Для сравнения элемента или атрибута со строкой или для передачи в функцию в качестве текста,
// необходимо привести его к строке, используя (string).
// В противном случае, PHP будет рассматривать элемент как объект.
//if ((string) $movies->movie->title == 'PHP: Появление Парсера') {
//    print 'Мой любимый фильм.';
//}
//
//echo htmlentities((string) $movies->movie->title);

// Сравнение двух элементов
//$movies1 = simplexml_load_file('/var/www/php_lvl_2.local/app/web/lesson_8/practice/xml/info.xml');
//$movies2 = simplexml_load_file('/var/www/php_lvl_2.local/app/web/lesson_8/practice/xml/info.xml');
//var_dump($movies1 === $movies2); // false начиная с PHP 5.2.0

// Использование XPath
// SimpleXML включает в себя встроенную поддержку XPath. Поиск всех элементов <character>
//foreach ($movies->xpath('//character') as $character) {
//    echo $character->name, ' играет ', $character->actor, PHP_EOL;
//}

// Установка значений
// Данные в SimpleXML не обязательно должны быть неизменяемыми. Объект позволяет манипулировать всеми элементами.
//$movies->movie[0]->characters->character[0]->name = 'Miss Coder';
//
//echo $movies->asXML();

// Добавление элементов и атрибутов
// SimpleXML имеет возможность легко добавлять дочерние элементы и атрибуты.
//$character = $movies->movie[0]->characters->addChild('character');
//$character->addChild('name', 'Mr. Parser');
//$character->addChild('actor', 'John Doe');
//
//$rating = $movies->movie[0]->addChild('rating', 'PG');
//$rating->addAttribute('type', 'mpaa');
//
//echo $movies->asXML();

// Взаимодействие с DOM
// PHP может преобразовывать XML-узлы из SimpleXML в формат DOM и наоборот.
// Этот пример показывает, как можно изменить DOM-элемент в SimpleXML.
//$dom = new DOMDocument;
//$dom->loadXML('<books><book><title>чепуха</title></book></books>');
//if (!$dom) {
//    echo 'Ошибка при разборе документа';
//    exit;
//}
//
//$books = simplexml_import_dom($dom);
//
//echo $books->book[0]->title;

// Загрузка синтаксически неправильной XML-строки
//libxml_use_internal_errors(true);
//$sxe = simplexml_load_string("<?xml version='1.0'><broken><xml></broken>");
//if (!$sxe) {
//    echo "Ошибка загрузки XML\n";
//    foreach(libxml_get_errors() as $error) {
//        echo "\t", $error->message;
//    }
//}