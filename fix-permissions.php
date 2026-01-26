#!/usr/bin/env php
<?php
/**
 * Fix storage permissions for Windows and Unix systems
 * Run: php fix-permissions.php
 */

function fixPermissions($path) {
    if (!is_dir($path)) {
        echo "Creating directory: $path\n";
        @mkdir($path, 0777, true);
    }

    if (is_writable($path)) {
        echo "✓ Writable: $path\n";
        return true;
    } else {
        echo "✗ Not writable: $path\n";
        if (PHP_OS_FAMILY !== 'Windows') {
            @chmod($path, 0777);
            echo "  Trying chmod 0777...\n";
        }
        return false;
    }
}

echo "Fixing storage permissions...\n\n";

$basePath = __DIR__ . DIRECTORY_SEPARATOR . 'storage';
$directories = [
    $basePath,
    $basePath . DIRECTORY_SEPARATOR . 'app',
    $basePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public',
    $basePath . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'teachers',
    $basePath . DIRECTORY_SEPARATOR . 'framework',
    $basePath . DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'cache',
    $basePath . DIRECTORY_SEPARATOR . 'logs',
];

foreach ($directories as $dir) {
    fixPermissions($dir);
}

echo "\nDone!\n";
