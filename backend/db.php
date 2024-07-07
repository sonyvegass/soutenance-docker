<?php

$host = "db";
$db_name = "docker";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4;unix_socket=/var/run/mysqld/mysqld.sock", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
