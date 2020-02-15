<?php

define("DB_HOST", "localhost");
define("DB_NAME", "recipes"); //Имя базы
define("DB_USER", "root"); //Пользователь
define("DB_PASSWORD", ""); //Пароль
define("PREFIX", "posts"); //Префикс если нужно

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->query("SET NAMES 'utf8'") or die("Ошибка соединения с базой!");

if (!empty($_POST["referal"])) { //Принимаем данные

    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));

    $db_referal = $mysqli->query("SELECT * from " . PREFIX . "search WHERE name LIKE '%$referal%'")
        or die('Ошибка №' . __LINE__ . '<br>Обратитесь к администратору сайта пожалуйста, сообщив номер ошибки.');

    while ($row = $db_referal->fetch_array()) {
        echo "\n<li>" . $row["name"] . "</li>"; //$row["name"] - имя поля таблицы
    }
}
