<?php
echo "PHP is working! Version: " . phpversion() . "\n";
echo "Extensions loaded:\n";
echo "- pdo: " . (extension_loaded('pdo') ? 'YES' : 'NO') . "\n";
echo "- pdo_pgsql: " . (extension_loaded('pdo_pgsql') ? 'YES' : 'NO') . "\n";
echo "- pdo_mysql: " . (extension_loaded('pdo_mysql') ? 'YES' : 'NO') . "\n";
echo "- openssl: " . (extension_loaded('openssl') ? 'YES' : 'NO') . "\n";
echo "- mbstring: " . (extension_loaded('mbstring') ? 'YES' : 'NO') . "\n";
echo "\nVendor exists: " . (file_exists(__DIR__ . '/../vendor/autoload.php') ? 'YES' : 'NO') . "\n";
echo ".env exists: " . (file_exists(__DIR__ . '/../.env') ? 'YES' : 'NO') . "\n";
echo "APP_KEY: " . (getenv('APP_KEY') ? 'SET' : 'NOT SET') . "\n";
echo "DB_HOST: " . (getenv('DB_HOST') ? getenv('DB_HOST') : 'NOT SET') . "\n";
