<?php
require_once __DIR__ . '/../components/auth_check.php';
require_once __DIR__ . '/../src/Event.php';
require_once __DIR__ . '/../src/helpers.php';

if (!isset($_GET['id'])) {
    header("Location: " . BASE_URL . "/public/index.php");
    exit();
}

$eventId = (int)$_GET['id'];
$event = (new Event())->getById($eventId);

// Authorization: Only event creator can delete
if ($_SESSION['user_id'] != $event['created_by'] && !User::isAdmin()) {
    header("Location: " . BASE_URL . "/public/index.php");
    exit();
}

// Perform deletion
try {
    (new Event())->delete($eventId);
    $_SESSION['success'] = "Event deleted successfully!";
} catch (Exception $e) {
    $_SESSION['error'] = "Error deleting event: " . $e->getMessage();
}

header("Location: " . BASE_URL . "/public/index.php");
exit();
