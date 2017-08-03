<?php
include 'connectDB.php';

    //Пишем логин и пароль из формы в переменные (для удобства работы):
    $login = $_POST['login'];
    $password = $_POST['password'];

    /*
        Формируем и отсылаем SQL запрос:
        ВЫБРАТЬ ИЗ таблицы_users ГДЕ поле_логин = $login
    */
    $query = 'SELECT*FROM messengerdb.users WHERE login="' . $login . '"';
    //Преобразуем ответ из БД в нормальный массив PHP:
    $user = mysqli_fetch_assoc(mysqli_query($link, $query));

    //Если база данных вернула не пустой ответ - значит такой логин есть...
    if (!empty($user)) {
        //Получим соль:
        $salt = $user['salt'];

        //Посолим пароль из формы:
        $saltedPassword = md5($password . $salt);

        //Если соленый пароль из базы совпадает с соленым паролем из формы...
        if ($user['password'] == $saltedPassword) {
            //Стартуем сессию:
            //session_start();

            //Пишем в сессию информацию о том, что мы авторизовались:
            $_SESSION['auth'] = true;

            /*
                Пишем в сессию логин и id пользователя
                (их мы берем из переменной $user!):
            */
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['login'];


            echo 'valid';

        } //Если соленый пароль из базы НЕ совпадает с соленым паролем из формы...
        else {
            echo 'invalid';
            //Выводим сообщение 'Неправильный логин или пароль'.
        }
    } else {
        echo 'invalid';
        //Нет такого логина, выведем сообщение об ошибке.
    }

