<?php
/**
 * Created by PhpStorm.
 * User: kelevra23
 * Date: 9/6/18
 * Time: 3:40 PM
 */

include 'conn.php';

if (isset($_POST['more'])) {
    $mult = $_POST['more'];
    try {
        $sql = "SELECT name FROM product LIMIT 2 * $mult OFFSET 0";
        $sth = $dbn->prepare($sql);
        $sth->execute();

        while ($result = $sth->fetch()) {
            $data[] = $result[0];
        }
    } catch (PDOException $e) {

    }

    foreach ($data as $line) {
        echo '<li>' . $line . '</li>';
    }
} else {
    try {
        $sql = "SELECT name FROM product LIMIT 2 OFFSET 0";
        $sth = $dbn->prepare($sql);
        $sth->execute();

        while ($result = $sth->fetch()) {
            $data[] = $result[0];
        }
    } catch (PDOException $e) {

    }

    foreach ($data as $line) {
        echo '<li>' . $line . '</li>';
    }
}

unset($dbn);