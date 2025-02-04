<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Event.php';

header('Content-Type: application/json');

try {
    $event = new Event();
    $eventId = isset($_GET['id']) ? (int)$_GET['id'] : null;
    
    if ($eventId) {
        $data = $event->getById($eventId);
    } else {
        $data = $event->getEvents(1, 100);
    }
    
    echo json_encode(['success' => true, 'data' => $data]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>