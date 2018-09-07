<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 9/6/18
 * Time: 4:03 PM
 */

try {
    $dbn = new PDO('mysql:dbname=store;host=localhost', 'admin', '123456');
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}

$dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);