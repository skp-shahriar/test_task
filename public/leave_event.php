<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Attendee.php';
require_once __DIR__ . '/../src/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: " . BASE_URL . "/public/index.php");
    exit();
}

try {
    // Validate CSRF token
    if (!validateCsrfToken($_POST['csrf_token'])) {
        throw new Exception("Invalid CSRF token.");
    }

    // Check authentication
    if (!User::isLoggedIn()) {
        throw new Exception("You must be logged in to leave an event.");
    }

    $eventId = (int)$_POST['event_id'];
    $userId = $_SESSION['user_id'];

    // Remove attendee
    $attendee = new Attendee();
    $success = $attendee->removeAttendee($eventId, $userId);

    $_SESSION['success'] = "You have successfully left the event.";
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
}

// Redirect back to event page
header("Location: " . BASE_URL . "/public/view_event.php?id=$eventId");
exit();
?>