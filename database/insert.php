<?php

$host = 'mysql';
$db = 'testdb';
$user = 'root';
$pass = 'password';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar a tabela se não existir
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS test_table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            value INT NOT NULL
        );
    ");

    // Prepare the insert statement
    $stmt = $pdo->prepare('INSERT INTO test_table (name, value) VALUES (:name, :value)');

    for ($i = 0; $i < 10000; $i++) {
        $name = 'Name ' . $i;
        $value = rand(1, 1000);
        $stmt->execute(['name' => $name, 'value' => $value]);
    }

    echo "Inserted 10,000 records into test_table.\n";

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
