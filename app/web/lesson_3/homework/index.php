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

try {
    $sql = "SELECT `id`, `thumb_adress` FROM `pictures` ORDER BY `view_count` DESC ";
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
