<?php
// файл db/connection.php

$path = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'pdo' . DIRECTORY_SEPARATOR . 'dbfile.sqlite';
$dsn = 'sqlite:' . $path;

try {
    // $pdo = new PDO($dsn_mysql, $user, $pass); // Для подключения к СУБД MySQL
    $pdo = new PDO($dsn); // Для подключения к СУБД SQLite
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'PDO DB connected'; // На этапе отладки можно раскомментировать эту строку.
} catch (PDOException $e) {
    echo $e->getMessage();
}
