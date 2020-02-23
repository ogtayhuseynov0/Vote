<?php
$host = "localhost";
$user = "root";
$pass = "root";
$db = "u161225217_usg";
try {
    $pdo = new PDO("mysql:dbname=$db;host=$host;charset=utf8", "$user", "$pass");

    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
