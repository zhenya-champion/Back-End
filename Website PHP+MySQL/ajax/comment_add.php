<?php

// получаем инфу от пользователя и фильтруем, удаляем пробелы
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));
$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

// проверяем на символы
if (strlen($username) < 2)
    $error = 'Введите имя';
else if (strlen($mess) < 5)
    $error = 'Введите сообщение';

    if($error != ''){
        echo $error;
        exit();
    }

require_once "../lib/mysql.php";

// обращаемся к бд
$sql = 'INSERT INTO comments(name, mess, article_id) VALUES(?, ?, ?)'; // куда и какие значения будем добавлять
$query = $pdo->prepare($sql); // куда передаем
$query->execute([$username, $mess, $id]); // Что подсталяем

echo "Done";
