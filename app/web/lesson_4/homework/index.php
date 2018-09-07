<?php

include 'backend/config.php';

include 'Twig/Autoloader.php';
Twig_Autoloader::register();

try {
    $dbh = new PDO($dsn, $dbUser, $dbPass);
} catch (PDOException $e) {
    echo "Error: Could not connect. " . $e->getMessage();
}

$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (isset($_POST['more'])) {
    $mult = $_POST['more'];

    try {
        $sql = "SELECT `id`, `thumb_adress` FROM `pictures` LIMIT 0," . 1 * $mult;
        $sth = $dbh->query($sql);
        while ($row = $sth->fetchObject()) {
            $data[] = $row;
        }

        unset($dbh);

        $loader = new Twig_Loader_Filesystem('templates');

        $twig = new Twig_Environment($loader);

        $template = $twig->loadTemplate('view.tmpl');

        echo $template->render(array(
            'data' => $data,
        ));

    } catch (Exception $e) {
        die ('ERROR: ' . $e->getMessage());
    }
} else {
    try {
        $sql = "SELECT `id`, `thumb_adress` FROM `pictures` LIMIT 0, 2";
        $sth = $dbh->query($sql);
        while ($row = $sth->fetchObject()) {
            $data[] = $row;
        }
        unset($dbh);

        $loader = new Twig_Loader_Filesystem('templates');

        $twig = new Twig_Environment($loader);

        $template = $twig->loadTemplate('view.tmpl');

        echo $template->render(array(
            'data' => $data,
        ));

    } catch (Exception $e) {
        die ('ERROR: ' . $e->getMessage());
    }
}
