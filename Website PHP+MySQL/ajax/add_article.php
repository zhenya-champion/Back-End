<?php

// получаем инфу от пользователя и фильтруем, удаляем пробелы
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'], FILTER_SANITIZE_EMAIL));
$full_text = trim(filter_var($_POST['full_text'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

// проверяем на символы
if (strlen($title) < 5)
    $error = 'Введите название';
else if (strlen($anons) < 10)
    $error = 'Введите анонс';
else if (strlen($full_text) < 10)
    $error = 'Введите full_text';

    if($error != ''){
        echo $error;
        exit();
    }

require_once "../lib/mysql.php";

// обращаемся к бд
$sql = 'INSERT INTO articles(title, anons, full_text, date, avtor) VALUES(?, ?, ?, ?, ?)'; // куда и какие значения будем добавлять
$query = $pdo->prepare($sql); // куда передаем
$query->execute([$title, $anons, $full_text, time(), $_COOKIE['login']]); // Что подсталяем

echo "Done";
