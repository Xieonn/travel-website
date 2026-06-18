<?php
// Tangkap semua error PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: text/plain');

echo "=== STEP 1: Load vendor/autoload.php ===\n";
try {
    require __DIR__ . '/../vendor/autoload.php';
    echo "OK\n\n";
} catch (Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    die();
}

echo "=== STEP 2: Load bootstrap/app.php ===\n";
try {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "OK\n\n";
} catch (Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
    die();
}

echo "=== STEP 3: Make HTTP Kernel ===\n";
try {
    $kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
    echo "OK\n\n";
} catch (Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
    die();
}

echo "=== STEP 4: Handle Request (will render homepage) ===\n";
try {
    $request = \Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    echo "Status Code: " . $response->getStatusCode() . "\n";
    echo "Content-Type: " . $response->headers->get('Content-Type') . "\n";
    echo "\n--- Response Preview (first 500 chars) ---\n";
    echo substr($response->getContent(), 0, 500) . "\n";
    $kernel->terminate($request, $response);
} catch (Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
}
