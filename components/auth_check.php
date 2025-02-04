<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/User.php';

if (!User::isLoggedIn()) {
    header("Location: " . BASE_URL . "/public/login.php");
    exit();
}
