<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 9/6/18
 * Time: 4:03 PM
 */

try {
    $dbn = new PDO('pgsql:dbname=admin;port=5432;host=localhost', 'admin', '123456');
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}

$dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);