<?php

// получаем инфу от пользователя и фильтруем, удаляем пробелы
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$pass = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

// проверяем на символы
if (strlen($login) < 3)
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

//Ищем пользователя
$sql = 'SELECT id FROM users WHERE `login` = ? AND `password` = ?';

// обращаемся к бд и добавляем
$query = $pdo->prepare($sql); // куда передаем(подготавливаем)
$query->execute([$login, $pass]); // Что подсталяем


// проверка на существование пользователя
if($query->rowCount() == 0)
 echo "Такого пользователя нет";
else{
//если cookie сбиваются, то меняем их название
 setcookie('login', $login, time() + 3600 * 24 * 30, "/"); //храним инфу о том что пользователь авторизован, видно для любого файла
 echo "Done"; // если всё в порядке
}
