<?php

// Load environment variables from .env file
function loadEnv() {
    $envFile = __DIR__ . '/.env';
    if (file_exists($envFile)) {
        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $_ENV[trim($key)] = trim($value);
            }
        }
    }
}

// Load environment variables
loadEnv();

// Razorpay configuration
define('RAZORPAY_KEY_ID', $_ENV['RAZORPAY_KEY_ID'] ?? '');
define('RAZORPAY_KEY_SECRET', $_ENV['RAZORPAY_KEY_SECRET'] ?? '');
define('RAZORPAY_MERCHANT_ID', $_ENV['RAZORPAY_MERCHANT_ID'] ?? ''); 