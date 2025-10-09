<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$APP_ENV = $_ENV['APP_ENV'];

if ($APP_ENV === 'development') {
    error_reporting(E_ALL);
}