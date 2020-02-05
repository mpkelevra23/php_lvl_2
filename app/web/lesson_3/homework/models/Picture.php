<?php

include_once 'Db.php';
include_once 'Transfer.php';

/**
 * Класс для работы с изображениями
 * Class Picture
 */
class Picture
{
    /**
     * TODO переделать логику метода, изменить возвращаемое значение
     * Сохраняем изображение
     * @return string
     */
    public static function save()
    {
        $type = (string)htmlspecialchars(strip_tags($_FILES['picture']['type']));
        $tmpName = (string)htmlspecialchars(strip_tags($_FILES['picture']['tmp_name']));
        $size = (int)htmlspecialchars(strip_tags($_FILES['picture']['size']));
        $error = htmlspecialchars(strip_tags($_FILES['picture']['error']));
        $name = (string)htmlspecialchars(strip_tags($_FILES['picture']['name']));

        if ($error != 0) {
            return 'Ошибка загрузки файла! ' . $error;
        } elseif ($size >= '10000000') {
            return 'Файл слишком большой.';
        } elseif ($type == 'image/jpeg' ||
            $type == 'image/png' ||
            $type == 'image/gif') {
            $file = Transfer::translate(basename($name));
            $address = './data/img/' . $file;
            $thumbAddress = './data/thumb/' . $file;

            if (move_uploaded_file($tmpName, "./data/img/" . $file)) {

                //создаём аватар картинки
                self::createThumb(150, 150, './data/img/' . $file, './data/thumb/' . $file, $type);

                try {
                    // Соединение с БД
                    $db = Db::getInstance()->getConnection();
                    // Сохраняем данные в БД.
                    $db->query("INSERT INTO `pictures` (`name`, address, thumb_address, `size`) VALUES ('$file', '$address', '$thumbAddress', '$size')");
                    // Закрываем соединение с БД
                    Db::getInstance()->closeConnection($db);
                } catch (PDOException $e) {
                    print "Error!: " . $e->getMessage() . "<br/>";
                    die();
                }

                return 'Файл успешно загружен';

            } else {
                return 'Возможная атака с помощью файловой загрузки!';
            }
        } else {
            return 'Формат файла должен быть JPEG, PNG или GIF';
        }
    }

    /**
     * Получение массива с картинками
     * @return array
     */
    public static function getPictures()
    {
        try {
            // Соединение с БД
            $db = Db::getInstance()->getConnection();
            // Получение и возврат результатов.
            $result = $db->query("SELECT `id`, `thumb_address` FROM `pictures` ORDER BY `view_count` DESC ")->fetchAll(PDO::FETCH_ASSOC);
            // Закрываем соединение с БД
            Db::getInstance()->closeConnection($db);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $result;
    }

    /**
     * Полуение картинки по id
     * @param $pictureId
     * @return mixed
     */
    public static function getPictureById($pictureId)
    {
        try {
            // Соединение с БД
            $db = Db::getInstance()->getConnection();
            // Получение и возврат результатов.
            $result = $db->query("SELECT `address` FROM `pictures` WHERE `id` = $pictureId")->fetch(PDO::FETCH_ASSOC);
            // Закрываем соединение с БД
            Db::getInstance()->closeConnection($db);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $result;
    }

    /**
     * Создаём аватар изображения
     * @param $height
     * @param $width
     * @param $src
     * @param $newsrc
     * @param $type
     */
    private static function createThumb($height, $width, $src, $newsrc, $type)
    {
        //должен быть установлен пакет функций для работы с изображениями gd, sudo apt-get install php7.2-gd
        $newimg = imagecreatetruecolor($height, $width);
        switch ($type) {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($src);
                imagecopyresampled($newimg, $img, 0, 0, 0, 0, $height, $width, imagesx($img), imagesy($img));
                imagejpeg($newimg, $newsrc);
                break;
            case 'image/png':
                $img = imagecreatefrompng($src);
                imagecopyresampled($newimg, $img, 0, 0, 0, 0, $height, $width, imagesx($img), imagesy($img));
                imagepng($newimg, $newsrc);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($src);
                imagecopyresampled($newimg, $img, 0, 0, 0, 0, $height, $width, imagesx($img), imagesy($img));
                imagegif($newimg, $newsrc);
                break;
        }
    }
}
