<?php

/**
 * Class UserController
 */
class UserController extends BaseController
{
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
        if (!User::isGuest()) {
            header("Location: /");
        } elseif (isset($_POST['submit'])) {
            $name = strip_tags($_POST['name']);
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);

            // Проверяем полученный данные от пользователя
            if (!User::checkName($name)) {
                $errors['name'] = 'Имя должно быть не меньше 6-ти символов';
            }
            if (!User::checkPassword($password)) {
                $errors['password'] = 'Пароль должно быть не меньше 6-ти символов';
            }
            if (!User::checkEmail($email)) {
                $errors['email'] = 'Пароль должно быть не меньше 6-ти символов';
            }
            if (parent::getUserObj()->checkEmailExists($email)) {
                $errors['email'] = 'Такой email уже существует';
            }

            if (empty($errors)) {
                // Если данные правильные, регистрируем пользователя на сайте, и возвращаем его id из бд
                $userId = parent::getUserObj()->registration($name, $email, $password);

                // Запоминаем пользователя (в сессию)
                parent::getUserObj()->authorization($userId['id']);

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
        if (!User::isGuest()) {
            header("Location: /");
        } elseif (isset($_POST['submit'])) {
            $email = strip_tags($_POST['email']);
            $password = strip_tags($_POST['password']);

            // Проверяем полученный данные от пользователя
            if (!User::checkEmail($email)) {
                $errors['email'] = 'Неправильный email';
            } elseif (!parent::getUserObj()->checkEmailExists($email)) {
                $errors['email'] = 'Пользователя с данным email не существует в базе';
            }
            if (!User::checkPassword($password)) {
                $errors['password'] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Если нет ошибок
            if (empty($errors)) {
                // Если данные правильные, аутентифицируем пользователя (существует ли данный пользоваель в бд)
                $userId = parent::getUserObj()->authentication($email, $password);
                //Проверяем есть ли такой пользователь
                if ($userId == false) {
                    // Если данные неправильные - показываем ошибку
                    $errors['userId'] = 'Неправильные данные для входа на сайт';
                } else {
                    // Если данные правильные, авторизируем (запоминаем пользователя в сессию)
                    parent::getUserObj()->authorization($userId);

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
        if (User::isGuest()) {
            header("Location: /");
        } else {
            //Сохраняем 5 последних адресов, на которых был пользователь
            $userId = $_SESSION['user'];
            $last_actions = array_slice($_SESSION['last_actions'], -5, 5);
            parent::getUserObj()->saveLastActions($userId, $last_actions);

            // Удаляем данные пользователя из сессии
            $_SESSION['user'] = null;
            $_SESSION['last_actions'] = null;
            session_destroy();

            // Переходим на главную страницу
            header('Location: /');
        }
    }
}
