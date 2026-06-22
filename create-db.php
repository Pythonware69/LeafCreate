<?php
try {
    // Connect to PostgreSQL default database first
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=postgres', 'postgres', 'kirk');
    
    // Create the database if it doesn't exist
    $pdo->exec("CREATE DATABASE weeb_2k26");
    echo "✓ Database 'weeb_2k26' created successfully!\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'already exists') !== false) {
        echo "✓ Database 'weeb_2k26' already exists\n";
    } else {
        echo "✗ Error: " . $e->getMessage() . "\n";
    }
}
?>
