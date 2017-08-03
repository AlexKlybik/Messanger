<?php
include 'connectDB.php';
    //Пишем логин и пароль из формы в переменные (для удобства работы):
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_confirm = $_POST['passwordConfirm']; //подтверждение пароля

    //Если пароль и его подтверждение совпадают...
    if ($password == $password_confirm) {
        /*
            Выполняем проверку на незанятость логина.
            Ответ базы запишем в переменную $isLoginFree.

            ВЫБРАТЬ ИЗ таблицы_users ГДЕ логин = $login.
        */
        $query = 'SELECT*FROM messengerdb.users WHERE login="' . $login . '"';
        $isLoginFree = mysqli_fetch_assoc(mysqli_query($link, $query));

        //Если $isLoginFree пустой - то логин не занят!
        if (empty($isLoginFree)) {
            //Генерируем соль с помощью функции generateSalt() и солим пароль...
            $salt = generateSalt(); //генерируем соль
            $saltedPassword = md5($password . $salt); //соленый пароль

            /*
                Формируем и отсылаем SQL запрос:

                ВСТАВИТЬ В таблицу_users УСТАНОВИТЬ
                логин = $login, пароль = $saltedPassword, salt = $salt
            */
            // $query = 'INSERT INTO messengerdb.users SET login="' . $login . '",password="' . $saltedPassword . '", salt="' . $salt . '"';
            $query = "INSERT INTO messengerdb.users(login, password, salt, date_last_exit) VALUES ('$login', '$saltedPassword', '$salt',NOW() )";
            mysqli_query($link, $query);

            //Выведем сообщение об успешной регистрации:
            echo 'valid';
        } //Если $isLoginFree НЕ пустой - то логин занят!
        else {
            echo 'busyLogin';
        }
    } //Если пароль и его подтверждение НЕ совпадают - выведем ошибку:
    else {
        echo 'diffPass';
    }


function generateSalt()
{
    $salt = '';
    $saltLength = 8; //длина соли
    for ($i = 0; $i < $saltLength; $i++) {
        $salt .= chr(mt_rand(33, 126)); //символ из ASCII-table
    }
    return $salt;
}