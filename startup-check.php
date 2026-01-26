#!/usr/bin/env php
<?php
/**
 * Startup Check Script
 * Проверяет что всё запущено и готово к работе
 */

echo "\n╔════════════════════════════════════════╗\n";
echo "║   MADINABONU - Startup Check          ║\n";
echo "╚════════════════════════════════════════╝\n\n";

// Check 1: PHP
echo "[1/5] PHP Version: ";
echo phpversion() . "\n";

// Check 2: Storage directories
echo "[2/5] Storage Directories: ";
$storageDir = __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public';
if (is_writable($storageDir)) {
    echo "✓ OK\n";
} else {
    echo "✗ PROBLEM (not writable)\n";
}

// Check 3: Database connection
echo "[3/5] Database Connection: ";
try {
    $pdo = new PDO(
        'mysql:host=127.0.0.1;port=3306;charset=utf8mb4',
        'root',
        ''
    );
    
    // Check database
    $stmt = $pdo->query("SELECT DATABASE()");
    $result = $stmt->fetch();
    
    echo "✓ Connected\n";
} catch (PDOException $e) {
    echo "✗ FAILED\n";
    echo "   Error: " . $e->getMessage() . "\n";
    echo "   Instructions:\n";
    echo "   1. Make sure MySQL is running in OSPanel\n";
    echo "   2. Start OSPanel (C:\\OSPanel\\bin\\ospanel.exe)\n";
    echo "   3. Check that MySQL service is active\n";
}

// Check 4: .env file
echo "[4/5] Configuration Files: ";
$envFile = __DIR__ . DIRECTORY_SEPARATOR . '.env';
if (file_exists($envFile)) {
    echo "✓ .env found\n";
} else {
    echo "✗ .env not found\n";
}

// Check 5: Teachers table
echo "[5/5] Database Tables: ";
try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema='madinabonu' AND table_name='teachers'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] > 0) {
        echo "✓ Teachers table exists\n";
    } else {
        echo "✗ Teachers table not found\n";
        echo "   Run migrations: php artisan migrate\n";
    }
} catch (Exception $e) {
    echo "✗ Cannot check\n";
}

echo "\n╔════════════════════════════════════════╗\n";
echo "║   Check Complete                      ║\n";
echo "╚════════════════════════════════════════╝\n";
echo "\nNext steps:\n";
echo "1. Make sure OSPanel is running\n";
echo "2. Check that MySQL is active in OSPanel control panel\n";
echo "3. Try accessing the site: http://localhost\n";
?>
