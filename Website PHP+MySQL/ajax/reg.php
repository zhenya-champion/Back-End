<?php

// получаем инфу от пользователя и фильтруем, удаляем пробелы
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

// проверяем на символы
if (strlen($username) < 2)
    $error = 'Введите имя';
else if (strlen($email) < 5)
    $error = 'Введите email';
else if (strlen($login) < 3)
    $error = 'Введите логин';
else if (strlen($pass) < 5)
    $error = 'Введите пароль';

    if($error != ''){
        echo $error;
        exit();
    }

require_once "../lib/mysql.php";

// защита пароля
$salt = 'sdfh^)#4390f79sdfg3'; // для защиты
$pass = md5($salt . $pass); // кеш

// обращаемся к бд
$sql = 'INSERT INTO users(name, email, login, password) VALUES(?, ?, ?, ?)'; // куда и какие значения будем добавлять
$query = $pdo->prepare($sql); // куда передаем
$query->execute([$username, $email, $login, $pass]); // Что подсталяем

echo "Done";
