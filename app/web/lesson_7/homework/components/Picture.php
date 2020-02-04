<?php

/**
 * Component для работы с изображениями
 * Class Picture
 */
class Picture
{
    private const ADDRESS = 'lesson_7/homework/upload/img/';
    private const THUMB_ADDRESS = 'lesson_7/homework/upload/thumb/';

    private $imgAddress;
    private $imgThumbAddress;

    private $type;
    private $tmpName;
    private $size;
    private $error;
    private $name;

    public function __construct($type, $tmpName, $size, $error, $name)
    {
        $this->setType($type);
        $this->setTmpName($tmpName);
        $this->setSize($size);
        $this->setError($error);
        $this->setName($name);
    }

    /**
     * @param $type
     * @return string
     */
    public function setType($type): string
    {
        return $this->type = (string)htmlspecialchars(strip_tags($type));
    }

    /**
     * @param $tmpName
     * @return string
     */
    public function setTmpName($tmpName): string
    {
        return $this->tmpName = (string)htmlspecialchars(strip_tags($tmpName));
    }

    /**
     * @param $size
     * @return int
     */
    public function setSize($size): int
    {
        return $this->size = (int)htmlspecialchars(strip_tags($size));
    }

    /**
     * @param $error
     * @return int
     */
    public function setError($error): int
    {
        return $this->error = (int)htmlspecialchars(strip_tags($error));
    }

    /**
     * @param $name
     * @return string
     */
    public function setName($name): string
    {
        return $this->name = (string)htmlspecialchars(strip_tags($name));
    }

    /**
     * @param $imgAddress
     * @return string
     */
    public function setImgAddress($imgAddress): string
    {
        return $this->imgAddress = $imgAddress;
    }

    /**
     * @param $imgThumbAddress
     * @return string
     */
    public function setImgThumbAddress($imgThumbAddress): string
    {
        return $this->imgThumbAddress = $imgThumbAddress;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getTmpName()
    {
        return $this->tmpName;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getImgAddress()
    {
        return $this->imgAddress;
    }

    /**
     * @return mixed
     */
    public function getImgThumbAddress()
    {
        return $this->imgThumbAddress;
    }


    /**
     * Сохраняем изображение
     * @return bool
     */
    public function save()
    {
        // Имя изображения
        $this->setName(Transfer::getTranslate(basename($this->name)));

        // Если изображение успешно перемещено, то создаём аватар
        if (is_uploaded_file($this->tmpName)) {
            if (move_uploaded_file($this->tmpName, self::ADDRESS . $this->name)) {
                // Если аватар изображения успешно создан, то сохраняем пути
                if (self::createThumb(200, 200, self::ADDRESS . $this->name, self::THUMB_ADDRESS . $this->name, $this->type)) {
                    // Адрес изображения
                    $this->setImgAddress(self::ADDRESS . $this->name);
                    // Адрес аватарки
                    $this->setImgThumbAddress(self::THUMB_ADDRESS . $this->name);
                    return true;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    /**
     * Проверям наличие ошибок
     * @return bool
     */
    public function checkError()
    {
        if ($this->error == 0) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем размер изображения
     * @return bool
     */
    public function checkSize()
    {
        if ($this->size <= 10000000) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем тип изображения
     * @return bool
     */
    public function checkType()
    {
        if ($this->type == 'image/jpeg' || $this->type == 'image/png' || $this->type == 'image/gif') {
            return true;
        }
        return false;
    }

    /**
     * Создаём аватар изображения
     * @param $height
     * @param $width
     * @param $src
     * @param $newsrc
     * @param $type
     * @return bool
     */
    private function createThumb($height, $width, $src, $newsrc, $type)
    {
        // Должен быть установлен пакет функций для работы с изображениями gd, sudo apt-get install php7.2-gd
        $newimg = imagecreatetruecolor($height, $width);
        switch ($type) {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($src);
                imagecopyresampled($newimg, $img, 0, 0, 0, 0, $height, $width, imagesx($img), imagesy($img));
                imagejpeg($newimg, $newsrc);
                return true;
                break;
            case 'image/png':
                $img = imagecreatefrompng($src);
                imagecopyresampled($newimg, $img, 0, 0, 0, 0, $height, $width, imagesx($img), imagesy($img));
                imagepng($newimg, $newsrc);
                return true;
                break;
            case 'image/gif':
                $img = imagecreatefromgif($src);
                imagecopyresampled($newimg, $img, 0, 0, 0, 0, $height, $width, imagesx($img), imagesy($img));
                imagegif($newimg, $newsrc);
                return true;
                break;
        }
        return false;
    }
}
