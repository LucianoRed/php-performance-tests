<?php

$host = 'mysql';
$db = 'testdb';
$user = 'root';
$pass = 'password';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verificar se a tabela já existe
    $tableCheckQuery = $pdo->query("
        SELECT COUNT(*)
        FROM information_schema.tables 
        WHERE table_schema = '$db' 
        AND table_name = 'test_table'
    ");
    
    $tableExists = $tableCheckQuery->fetchColumn() > 0;

    if (!$tableExists) {
        // Criar a tabela se não existir
        $pdo->exec("
            CREATE TABLE test_table (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                value INT NOT NULL
            );
        ");
        echo "Tabela 'test_table' criada com sucesso.\n";
    } else {
        echo "Tabela 'test_table' já existe.\n";
    }

    // Verificar quantos registros existem na tabela
    $countQuery = $pdo->query('SELECT COUNT(*) FROM test_table');
    $rowCount = $countQuery->fetchColumn();

    if ($rowCount < 10000) {
        // Inserir registros faltantes
        $stmt = $pdo->prepare('INSERT INTO test_table (name, value) VALUES (:name, :value)');
        for ($i = $rowCount; $i < 10000; $i++) {
            $name = 'Name ' . $i;
            $value = rand(1, 1000);
            $stmt->execute(['name' => $name, 'value' => $value]);
        }
        echo "Inseridos " . (10000 - $rowCount) . " registros na tabela 'test_table'.\n";
    } else {
        echo "A tabela 'test_table' já contém 10.000 registros ou mais.\n";
    }

} catch (PDOException $e) {
    echo 'Falha na conexão: ' . $e->getMessage() . "\n";
}
