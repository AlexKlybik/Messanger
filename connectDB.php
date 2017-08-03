<?php
session_start();
$host = 'localhost:3306'; // адрес сервера
$database = 'messengerdb'; // имя базы данных
$user = 'root'; // имя пользователя
$password = 'root'; // пароль

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));
