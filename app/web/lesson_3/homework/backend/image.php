<?php

include 'config.php';

$adress = $_POST['adress'];

include '../Twig/Autoloader.php';
Twig_Autoloader::register();

//try {
//    $dbh = new PDO($dsn, $dbUser, $dbPass);
//} catch (PDOException $e) {
//    echo "Error: Could not connect. " . $e->getMessage();
//}
//
//$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//try {
//    $sql = "SELECT `adress` FROM `pictures` WHERE `id` = $id";
//    $sth = $dbh->query($sql);
//    while ($row = $sth->fetchObject()) {
//        $data[] = $row;
//    }
//
//    unset($dbh);
try {

    $loader = new Twig_Loader_Filesystem('../templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('image.tmpl');

    echo $template->render([
        'adress' => $adress
    ]);

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}