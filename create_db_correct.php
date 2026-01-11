<?php
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

echo "Testing connection with password '1234'...\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '1234', $options);
    echo "Connected successfully to MySQL with password '1234'.\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS veterinaria_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database 'veterinaria_laravel' created successfully.\n";
    exit(0);
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
