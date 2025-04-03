<?php
// Simple PHP server script for Nairobi Pulse
$port = 8080;
$host = '0.0.0.0';

echo "Starting PHP development server at http://{$host}:{$port}" . PHP_EOL;
echo "Press Ctrl+C to stop the server" . PHP_EOL;

// Execute the PHP built-in server
passthru("php -S {$host}:{$port} -t .");
?>