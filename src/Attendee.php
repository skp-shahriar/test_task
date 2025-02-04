<?php
class Attendee
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function register($eventId, $userId)
    {
        // Check capacity
        $eventStmt = $this->db->prepare("
            SELECT capacity, 
            (SELECT COUNT(*) FROM attendees WHERE event_id = ?) AS registered 
            FROM events WHERE id = ?
        ");
        $eventStmt->bind_param("ii", $eventId, $eventId);
        $eventStmt->execute();
        $event = $eventStmt->get_result()->fetch_assoc();

        if ($event['registered'] >= $event['capacity']) {
            throw new Exception("Event is full");
        }

        // Register
        $stmt = $this->db->prepare("
            INSERT INTO attendees (event_id, user_id)
            VALUES (?, ?)
        ");
        $stmt->bind_param("ii", $eventId, $userId);
        return $stmt->execute();
    }

    public function getAttendees($eventId)
    {
        $stmt = $this->db->prepare("
        SELECT users.id AS user_id, users.username, users.email, attendees.registration_date 
        FROM attendees 
        JOIN users ON attendees.user_id = users.id
        WHERE event_id = ?
    ");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function removeAttendee($eventId, $userId)
    {
        $stmt = $this->db->prepare("
            DELETE FROM attendees 
            WHERE event_id = ? AND user_id = ?
        ");
        $stmt->bind_param("ii", $eventId, $userId);

        if (!$stmt->execute()) {
            throw new Exception("Failed to leave event: " . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }
}
