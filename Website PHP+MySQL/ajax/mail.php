<?php

// получаем инфу от пользователя и фильтруем, удаляем пробелы
$username = trim(filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

// проверяем на символы
if (strlen($username) < 2)
    $error = 'Введите имя';
else if (strlen($email) < 5)
    $error = 'Введите email';
else if (strlen($mess) < 10)
    $error = 'Введите сообщение';

if($error != ''){
    echo $error;
    exit();
}

$to = "admin@skyline.com"; // кому
$subject = "=?utf-8?B?".base64_encode("Новое сообщение")."?="; // тема с кодировкой
$message = "Пользователь: $username.<br>$mess"; // сообщение
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n"; // заголовок с переводом коретки и кодировкой

mail($to, $subject, $message, $headers);

echo "Done";
