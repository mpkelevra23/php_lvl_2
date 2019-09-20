<?php

include 'models/Picture.php';

include 'Twig/Autoloader.php';

Twig_Autoloader::register();

$lastLink = $_SERVER['HTTP_REFERER'];

$pictureId = $_GET['photo'];

$picture = Picture::getPictureById($pictureId);

try {
    $loader = new Twig_Loader_Filesystem('templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('image.tmpl');

    echo $template->render(array(
        'address' => $picture['address'],
        'lastLink' => $lastLink
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}