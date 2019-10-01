<?php

const DB_DRIVER = 'mysql';
const DB_USER = 'admin';
const DB_PASS = 123456;
const DB_HOST = 'localhost';
const DB_NAME = 'geekbrains';
const DB_CHARSET = 'utf8';

try {
    $dsn = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    foreach ($dbh->query('SELECT * from Customers') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
