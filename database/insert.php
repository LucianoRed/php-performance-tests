<?php

$host = 'mysql';
$db = 'testdb';
$user = 'root';
$pass = 'password';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Drop the table if it exists
    $pdo->exec("DROP TABLE IF EXISTS test_table");

    // Create the table
    $pdo->exec("
        CREATE TABLE test_table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            value INT NOT NULL
        );
    ");
    echo "Tabela 'test_table' criada com sucesso.\n";

    // Inserir 10.000 registros na tabela
    $stmt = $pdo->prepare('INSERT INTO test_table (name, value) VALUES (:name, :value)');
    for ($i = 0; $i < 10000; $i++) {
        $name = 'Name ' . $i;
        $value = rand(1, 1000);
        $stmt->execute(['name' => $name, 'value' => $value]);
    }
    echo "Inseridos 10.000 registros na tabela 'test_table'.\n";

} catch (PDOException $e) {
    echo 'Falha na conexão: ' . $e->getMessage() . "\n";
}
