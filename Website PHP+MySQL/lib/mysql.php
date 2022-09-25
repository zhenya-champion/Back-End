<?php
// настойки бд
$user = 'root';
$password = 'root';
$db = 'web-blog';
$host = 'localhost';
$port = 3306;

// подключение к бд
$dsn = 'mysql:host=' . $host . ';dbname=' . $db . ';port=' . $port;
$pdo = new PDO($dsn, $user, $password); // используем класс PDO метод подключения