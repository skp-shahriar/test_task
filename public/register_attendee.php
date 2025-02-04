<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Attendee.php';
require_once __DIR__ . '/../src/helpers.php';

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method.");
    }

    // Validate CSRF token
    if (!validateCsrfToken($_POST['csrf_token'])) {
        throw new Exception("Invalid CSRF token.");
    }

    // Check authentication
    if (!User::isLoggedIn()) {
        throw new Exception("You must be logged in to register.");
    }

    $eventId = (int)$_POST['event_id'];
    $userId = $_SESSION['user_id'];

    // Register attendee
    $attendee = new Attendee();
    $success = $attendee->register($eventId, $userId);

    echo json_encode(['success' => $success, 'message' => 'Registration successful!']);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
