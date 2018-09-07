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
        $sql = "SELECT `name` FROM `pictures` LIMIT 0," . 1 * $mult;
        $sth = $dbn->prepare($sql);
        $sth->execute();

        while ($result = $sth->fetch()) {
            $data[] = $result[0];
        }
    } catch (PDOException $e) {

    }

    foreach ($data as $line) {
        echo '<li>' . $line . '<line>';
    }
} else {
    try {
        $sql = "SELECT `name` FROM `pictures` LIMIT 0, 1";
        $sth = $dbn->prepare($sql);
        $sth->execute();

        while ($result = $sth->fetch()) {
            $data[] = $result[0];
        }
    } catch (PDOException $e) {

    }

    foreach ($data as $line) {
        echo '<li>' . $line . '<line>';
    }
}

unset($dbn);