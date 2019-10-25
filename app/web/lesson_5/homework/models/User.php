<?php

/**
 * Класс для работы с пользователем
 * Class User
 */
class User
{
    /**
     * Регистрация пользователя в бд
     * @param $name
     * @param $email
     * @param $password
     * @return string
     */
    public static function registration($name, $email, $password)
    {
        // Хэшируем пароль
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Подключаемся к бд
        $dbh = Db::getConnection();

        // Подготовленный запрос
        $sth = $dbh->prepare('INSERT INTO lesson_5.users(name, email, password) VALUES (:name, :email, :password)');
        $sth->bindParam(':name', $name, PDO::PARAM_STR);
        $sth->bindParam(':email', $email, PDO::PARAM_STR);
        $sth->bindParam(':password', $password, PDO::PARAM_STR);

        // Выполняем подготовленный запрос
        $sth->execute();

        // Получаем id нового пользователя
        $result = $dbh->lastInsertId();

        // Закрываем соединение с бд
        $sth = null;
        $dbh = null;

        // Возвращаем результат запроса
        return $result;
    }

    /**
     * Аутентификация пользователя
     * @param $email
     * @param $password
     * @return bool
     */
    public static function authentication($email, $password)
    {
        // Подключаемся к бд
        $dbh = Db::getConnection();

        // Подготовленный запрос
        $sth = $dbh->prepare('SELECT id, password FROM lesson_5.users WHERE email = :email');
        $sth->bindParam(':email', $email, PDO::PARAM_STR);

        // Выполняем подготовленный запрос
        $sth->execute();

        // Сохраняем результат запроса
        $user = $sth->fetch();

        // Закрываем соединение с бд
        $sth = null;
        $dbh = null;

        // Если пароль верный, возвращаем id пользователя
        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
        return false;
    }

    /**
     * Авторизация пользователя
     * @param $userId
     * @return mixed
     */
    public static function authorization($userId)
    {
        // Записываем id пользователя в сессию
        $_SESSION['user'] = $userId;
        // Записываем данные о последних посещённых страницах
        if (User::getLastActions($_SESSION['user']) == false) {
            // Присваиваем пустой массив, если нет данных о последних посещённых страницах
            $_SESSION['last_actions'] = [];
        } else {
            // Присваиваем данные о последних посещённых страницах
            $_SESSION['last_actions'] = self::getLastActions($_SESSION['user']);
        }
    }

    /**
     * Получаем данные о пользователе
     * @param $id
     * @return mixed
     */
    public static function getUserById($id)
    {
        // Подключаемся к бд
        $dbh = Db::getConnection();

        $sth = $dbh->prepare('SELECT * FROM lesson_5.users WHERE id = :id');
        $sth->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем подготовленный запрос
        $sth->execute();

        // Сохраняем результат запроса
        $result = $sth->fetch();

        // Закрываем соединение с бд
        $sth = null;
        $dbh = null;

        // Возвращаем результат запроса
        return $result;
    }

    /**
     * Проверяем является ли пользователь гостем
     * @return bool
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    /**
     * Проверяем существует ли email в бд
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {
        // Подключаемся к бд
        $dbh = Db::getConnection();

        // Подготовленный запрос
        $sth = $dbh->prepare('SELECT COUNT(*) FROM lesson_5.users WHERE email = :email');
        $sth->bindParam(':email', $email, PDO::PARAM_STR);

        // Выполняем подготовленный запрос
        $sth->execute();

        // Сохраняем результат запроса
        $result = $sth->fetchColumn();

        // Закрываем соединение с бд
        $sth = null;
        $dbh = null;

        // Возвращаем результат запроса
        if ($result) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем email
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем имя
     * @param $name
     * @return bool
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем пароль
     * @param $password
     * @return bool
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Сохраняем 5 последних адресов, на которых был пользователь
     * @param $userId
     * @param $last_actions
     * @return bool
     */
    public static function saveLastActions($userId, $last_actions)
    {

        // Сериализуем последние действия пользователя
        $last_actions = serialize($last_actions);

        // Подключаемся к бд
        $dbh = Db::getConnection();

        // Подготовленный запрос
        $sth = $dbh->prepare('UPDATE lesson_5.users SET last_actions = :last_actions WHERE id = :id');
        $sth->bindParam(':last_actions', $last_actions, PDO::PARAM_STR);
        $sth->bindParam(':id', $userId, PDO::PARAM_INT);

        // Выполняем подготовленный запрос
        $result = $sth->execute();

        // Закрываем соединение с бд
        $sth = null;
        $dbh = null;

        // Возвращаем результат запроса
        return $result;

    }

    /**
     * Получаем 5 последних адресов, на которых был пользователь
     * @param $id
     * @return bool|mixed
     */
    public static function getLastActions($id)
    {
        // Подключаемся к бд
        $dbh = Db::getConnection();

        // Подготовленный запрос
        $sth = $dbh->prepare('SELECT last_actions FROM lesson_5.users WHERE id = :id');
        $sth->bindParam(':id', $id, PDO::PARAM_INT);

        // Выполняем подготовленный запрос
        $sth->execute();

        // Сохраняем результат запроса
        $result = $sth->fetch();

        // Закрываем соединение с бд
        $sth = null;
        $dbh = null;

        // Возвращаем результат запроса
        if (!is_null($result)) {
            return unserialize($result['last_actions']);
        } else {
            return false;
        }
    }

    /**
     * Отслеживаем последние адреса, на которых был пользователь
     */
    public static function trackingUserActions()
    {
        // Проверям существует ли массив с последними посещёнными страницами
        if (isset($_SESSION['last_actions']) && is_array($_SESSION['last_actions'])) {

            // Считываем кол-во элементов в массиве
            $count = count($_SESSION['last_actions']);

            // Увеличиваем на единицу
            $count++;

            // Добавляем новый элемент в массив
            $_SESSION['last_actions'][$count] = Router::getURI();
        }
    }
}
