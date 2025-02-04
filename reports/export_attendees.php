<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../src/Event.php';
require_once __DIR__ . '/../src/Attendee.php';
require_once __DIR__ . '/../src/helpers.php';

// Check authentication
if (!User::isLoggedIn()) {
    header("Location: " . BASE_URL . "/public/login.php");
    exit();
}

$eventId = (int)$_GET['event_id'];
$event = (new Event())->getById($eventId);

// Authorization: Only event creator can download
if ($_SESSION['user_id'] != $event['created_by'] && !User::isAdmin()) {
    header("HTTP/1.1 403 Forbidden");
    exit("Access denied");
}

$attendee = new Attendee();
$attendees = $attendee->getAttendees($eventId);

// Generate CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="attendees_'.$eventId.'.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Name', 'Email', 'Registration Date']);

foreach ($attendees as $row) {
    fputcsv($output, [
        $row['username'],
        $row['email'],
        date('Y-m-d H:i', strtotime($row['registration_date']))
    ]);
}

fclose($output);
exit();
?>