<?php
require_once __DIR__ . '/../config.php';

// Destroy session
session_unset();
session_destroy();

// Redirect to login
header("Location: " . BASE_URL . "/public/login.php");
exit();
