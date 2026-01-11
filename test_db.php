<?php
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

echo "Testing connection with NO password...\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '', $options);
    echo "Connected successfully to MySQL with NO password.\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS veterinaria_laravel");
    echo "Database 'veterinaria_laravel' created successfully.\n";
    exit(0);
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage() . "\n";
}

echo "Testing connection with password 'root'...\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', 'root', $options);
    echo "Connected successfully to MySQL with password 'root'.\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS veterinaria_laravel");
    echo "Database 'veterinaria_laravel' created successfully.\n";
    exit(0);
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage() . "\n";
}

echo "All attempts failed.\n";
exit(1);
?>
