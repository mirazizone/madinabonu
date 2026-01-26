<?php
echo "=== PHP Configuration ===\n\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "max_input_time: " . ini_get('max_input_time') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "file_uploads: " . (ini_get('file_uploads') ? 'ON' : 'OFF') . "\n";
echo "upload_tmp_dir: " . (ini_get('upload_tmp_dir') ?: 'default') . "\n";
echo "\n=== File Upload Support ===\n";
echo "File uploads: " . (ini_get('file_uploads') ? 'ENABLED' : 'DISABLED') . "\n";
echo "\n=== Storage Path ===\n";
echo "Storage path: " . __DIR__ . DIRECTORY_SEPARATOR . "storage" . "\n";
?>
