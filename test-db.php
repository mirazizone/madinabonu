<?php
echo "=== Database Connection Test ===\n\n";

try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;port=3306',
        'root',
        ''
    );
    echo "✓ MySQL Connection: SUCCESS\n";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'madinabonu'");
    if ($stmt->fetch()) {
        echo "✓ Database 'madinabonu': EXISTS\n";
    } else {
        echo "✗ Database 'madinabonu': NOT FOUND\n";
    }
    
} catch (PDOException $e) {
    echo "✗ MySQL Connection FAILED:\n";
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nCheck if:\n";
    echo "1. MySQL is running\n";
    echo "2. Host: 127.0.0.1\n";
    echo "3. Port: 3306\n";
    echo "4. User: root\n";
}
?>
