<?php
 setcookie('login', '', time() - 3600 * 24 * 30, "/"); //удаляем cookie
 unset($_COOKIE['login']); // удаляем значение из cookie