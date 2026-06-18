<?php
// Tangkap semua error PHP
ini_set('display_errors', 1);
error_reporting(E_ALL);

set_error_handler(function($errno, $errstr, $errfile, $errline) {
    echo "[PHP ERROR $errno]: $errstr\n";
    echo "  File: $errfile Line: $errline\n\n";
    return true;
});

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
    use Illuminate\Contracts\Http\Kernel;
    $kernel = $app->make(Kernel::class);
    echo "OK\n\n";
} catch (Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
    die();
}

echo "=== STEP 4: Handle Request ===\n";
try {
    use Illuminate\Http\Request;
    $request = Request::capture();
    $response = $kernel->handle($request);
    echo "Status: " . $response->getStatusCode() . "\n";
    $response->send();
    $kernel->terminate($request, $response);
} catch (Throwable $e) {
    echo "FAILED: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "\nTrace:\n" . $e->getTraceAsString() . "\n";
}
