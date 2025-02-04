<?php
session_start();

// Database Configuration
define('DB_HOST', 'localhost'); 
define('DB_NAME', 'event_management');
define('DB_USER', 'root');
define('DB_PASS', '');

// Base URL Configuration
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$base_url = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));
define('BASE_URL', "$protocol://$host$base_url");

// Load Core Classes
require_once __DIR__ . '/src/Database.php';
require_once __DIR__ . '/src/User.php';

?>