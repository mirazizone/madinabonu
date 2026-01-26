<?php
/**
 * Create symbolic link for storage
 * Run: php create-link.php
 */

$source = __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'public';
$link = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage';

// Check if link already exists
if (is_link($link)) {
    echo "Symbolic link already exists at: $link\n";
    exit(0);
}

// Check if target directory exists
if (!is_dir($source)) {
    echo "Source directory does not exist: $source\n";
    exit(1);
}

// Try to create symbolic link
if (PHP_OS_FAMILY === 'Windows') {
    // On Windows, try using junction
    $cmd = "mklink /J \"$link\" \"$source\"";
    system($cmd, $return_code);
    if ($return_code !== 0) {
        echo "Failed to create junction (try running as Administrator)\n";
        echo "Command: $cmd\n";
        exit(1);
    }
} else {
    // On Unix-like systems
    if (!symlink($source, $link)) {
        echo "Failed to create symbolic link\n";
        exit(1);
    }
}

echo "Symbolic link created successfully!\n";
echo "Source: $source\n";
echo "Link: $link\n";
exit(0);
