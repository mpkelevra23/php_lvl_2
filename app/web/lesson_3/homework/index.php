<?php

include_once 'models/Picture.php';

include_once 'Twig/Autoloader.php';

Twig_Autoloader::register();

if (!empty($_FILES) && is_uploaded_file($_FILES['picture']['tmp_name'])) {
    Picture::save();
    header("Location: index.php");
} else $message = 'Выберите файл для загрузки';

$pictures = Picture::getPictures();

try {
    $loader = new Twig_Loader_Filesystem('templates');

    $twig = new Twig_Environment($loader);

    $template = $twig->loadTemplate('view.tmpl');

    echo $template->render(array(
        'pictures' => $pictures,
        'message' => $message,
    ));

} catch (Exception $e) {
    die ('ERROR: ' . $e->getMessage());
}
