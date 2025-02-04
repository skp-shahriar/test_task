<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/User.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>/public/assets/css/style.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= BASE_URL ?>/public/index.php">Event Management System</a>
        <div class="d-flex">
            <?php if (User::isLoggedIn()): ?>
                <a href="<?= BASE_URL ?>/public/create_event.php" class="btn btn-success me-2">
                    Create Event
                </a>
                <a href="<?= BASE_URL ?>/public/logout.php" class="btn btn-outline-light">Logout</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="content-wrapper">