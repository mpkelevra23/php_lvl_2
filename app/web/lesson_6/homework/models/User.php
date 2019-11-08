<?php

/**
 * Класс для работы с пользователем
 * Class User
 */
class User
{
    // Объект класса Db
    private $dbh;

    /**
     * Создаём объект класса Db
     * User constructor.
     */
    public function __construct()
    {
        return $this->dbh = Db::getInstance();
    }

    /**
     * Регистрация пользователя в бд
     * @param $name
     * @param $email
     * @param $password
     * @return mixed
     */
    public function registration($name, $email, $password)
    {
        // Хэшируем пароль
        $password = password_hash($password, PASSWORD_BCRYPT);

        // Выполняем запрос
        $this->dbh->run('INSERT INTO lesson_6.users(name, email, password) VALUES (:name, :email, :password)', [$name, $email, $password]);

        // Получаем id нового пользователя
        return $this->dbh->lastInsertId();
    }

    /**
     * Аутентификация пользователя
     * @param $email
     * @param $password
     * @return bool
     */
    public function authentication($email, $password)
    {
        // Выполняем запрос
        $user = $this->dbh->run('SELECT id, password FROM lesson_6.users WHERE email = :email', [$email])->fetch();

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
    public function authorization($userId)
    {
        // Записываем id пользователя в сессию
        $_SESSION['user'] = $userId;
        // Записываем данные о последних посещённых страницах
        if (self::getLastActions($_SESSION['user']) == false) {
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
    public function getUserById($id)
    {
        // Выполняем и возвращаем результат запрос
        return $this->dbh->run('SELECT * FROM lesson_6.users WHERE id = :id', [$id])->fetch();
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
    public function checkEmailExists($email)
    {
        // Выполняем запрос
        $result = $this->dbh->run('SELECT COUNT(*) FROM lesson_6.users WHERE email = :email', [$email])->fetchColumn();

        // Возвращаем результат проверки
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
    public function checkEmail($email)
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
    public function checkName($name)
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
    public function checkPassword($password)
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
     * @return bool|false|PDOStatement
     */
    public function saveLastActions($userId, $last_actions)
    {
        // Сериализуем последние действия пользователя
        $last_actions = serialize($last_actions);

        // Выполняем запрос
        return $this->dbh->run('UPDATE lesson_6.users SET last_actions = :last_actions WHERE id = :id', [$last_actions, $userId]);
    }

    /**
     * Получаем 5 последних адресов, на которых был пользователь
     * @param $id
     * @return bool|mixed
     */
    public function getLastActions($id)
    {
        // Выполняем запрос
        $result = $this->dbh->run('SELECT last_actions FROM lesson_6.users WHERE id = :id', [$id])->fetch();

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
