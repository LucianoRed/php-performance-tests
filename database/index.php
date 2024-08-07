<?php

$host = 'mysql';
$db = 'testdb';
$user = 'root';
$pass = 'password';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT COUNT(*) FROM test_table');
    $count = $stmt->fetchColumn();

    echo "There are $count rows in test_table.\n";

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
