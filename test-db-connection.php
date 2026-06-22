<?php
try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=weeb_2k26', 'postgres', 'kirk');
    echo "✓ Connected to PostgreSQL successfully!\n";
    
    // Test a simple query
    $stmt = $pdo->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "PostgreSQL Version: " . $version . "\n";
} catch (PDOException $e) {
    echo "✗ Connection Error: " . $e->getMessage() . "\n";
}
?>
