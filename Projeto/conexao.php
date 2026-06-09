<?php

$host   = 'localhost';
$db     = 'hotel';
$user = 'root';
$pass = 'YES';
$charset = 'utf8mb4';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("<div class='container mt-4'><div class='alert alert-danger'>Erro na conexão com o banco: " . $e->getMessage() . "</div></div>");
}
