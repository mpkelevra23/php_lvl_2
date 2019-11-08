<?php

/**
 * Class UserController
 */
class UserController
{
    // Объект класса User
    private $user;

    /**
     * Создаём объект класса User
     * UserController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Регистрация пользователя
     * @return mixed
     */
    public function actionRegistration()
    {
        // Переменные для формы
        $name = false;
        $email = false;
        $password = false;

        // Если пользователь не вошёл в систему, отправляем его на главную страницу
        if (!$this->user->isGuest()) {
            header("Location: /index/");
        } elseif (isset($_POST['submit'])) {
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);

            // Проверяем полученный данные от пользователя
            if (!$this->user->checkName($name)) {
                $errors['name'] = 'Имя должно быть не меньше 6-ти символов';
            }
            if (!$this->user->checkPassword($password)) {
                $errors['password'] = 'Пароль должно быть не меньше 6-ти символов';
            }
            if (!$this->user->checkEmail($email)) {
                $errors['email'] = 'Пароль должно быть не меньше 6-ти символов';
            }
            if ($this->user->checkEmailExists($email)) {
                $errors['email'] = 'Такой email уже существует';
            }

            if (empty($errors)) {
                // Если данные правильные, регистрируем пользователя на сайте, и возвращаем его id из бд
                $userId = $this->user->registration($name, $email, $password);

                // Запоминаем пользователя (сессия)
                $this->user->authorization($userId);

                // Перенаправляем пользователя в закрытую часть - кабинет
                header("Location: /cabinet/");
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/user/registration.php');

        return true;
    }

    /**
     * Аутентификация и авторизация пользователя
     * @return mixed
     */
    public function actionLogin()
    {
        // Переменные для формы
        $email = false;
        $password = false;

        // Если пользователь не вошёл в систему, отправляем его на главную страницу
        if (!$this->user->isGuest()) {
            header("Location: /index/");
        } elseif (isset($_POST['submit'])) {
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);

            // Проверяем полученный данные от пользователя
            if (!$this->user->checkEmail($email)) {
                $errors['email'] = 'Неправильный email';
            } elseif (!$this->user->checkEmailExists($email)) {
                $errors['email'] = 'Пользователя с данным email не существует в базе';
            }
            if (!$this->user->checkPassword($password)) {
                $errors['password'] = 'Пароль не должен быть короче 6-ти символов';
            }

            if (empty($errors)) {
                // Если данные правильные, аутентифицируем пользователя (существует ли данный пользоваель в бд)
                $userId = $this->user->authentication($email, $password);
                //Проверяем есть ли такой пользователь
                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors['userId'] = 'Неправильные данные для входа на сайт';
                } else {
                    // Если данные правильные, авторизируем (запоминаем пользователя в сессию)
                    $this->user->authorization($userId);

                    // Перенаправляем пользователя в закрытую часть - кабинет
                    header("Location: /cabinet/");
                }
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        // Если пользователь не вошёл в систему, отправляем его на главную страницу
        if ($this->user->isGuest()) {
            header("Location: /index/");
        } else {
            //Сохраняем 5 последних адресов, на которых был пользователь
            $userId = $_SESSION['user'];
            $last_actions = array_slice($_SESSION['last_actions'], -5, 5);
            $this->user->saveLastActions($userId, $last_actions);

            // Удаляем данные пользователя из сессии
            $_SESSION['user'] = null;
            $_SESSION['last_actions'] = null;
            session_destroy();

            // Переходим на главную страницу
            header('Location: /index/');
        }
    }
}
