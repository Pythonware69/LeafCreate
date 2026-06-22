<?php
try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=weeb_2k26', 'postgres', 'kirk');
    
    // Enable PostGIS extension
    $pdo->exec("CREATE EXTENSION IF NOT EXISTS postgis");
    echo "✓ PostGIS extension enabled!\n";
} catch (PDOException $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
?>
