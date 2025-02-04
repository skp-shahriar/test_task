<?php
class Event
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function create($title, $description, $date, $location, $capacity, $userId)
    {
        $stmt = $this->db->prepare("
            INSERT INTO events 
            (title, description, date, location, capacity, created_by)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssii", $title, $description, $date, $location, $capacity, $userId);
        return $stmt->execute();
    }

    public function update($eventId, $title, $description, $date, $location, $capacity)
    {
        $stmt = $this->db->prepare("
            UPDATE events SET
            title = ?, description = ?, date = ?, location = ?, capacity = ?
            WHERE id = ?
        ");
        $stmt->bind_param("ssssii", $title, $description, $date, $location, $capacity, $eventId);
        return $stmt->execute();
    }

    public function delete($eventId)
    {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $eventId);
        return $stmt->execute();
    }

    public function getEvents($page = 1, $perPage = 10, $search = '', $sort = 'date') {
        $offset = ($page - 1) * $perPage;
        $searchTerm = "%$search%";
        
        // Validate allowed sort columns
        $allowedSorts = ['date', 'title'];
        $sortColumn = in_array($sort, $allowedSorts) ? $sort : 'date';
        
        $sql = "SELECT * FROM events 
                WHERE title LIKE ? OR description LIKE ?
                ORDER BY `$sortColumn` DESC 
                LIMIT ? OFFSET ?";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssii", $searchTerm, $searchTerm, $perPage, $offset);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalEvents($search = '') {
        $searchTerm = "%$search%";
        $stmt = $this->db->prepare("
            SELECT COUNT(*) AS total 
            FROM events 
            WHERE title LIKE ? OR description LIKE ?
        ");
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return (int)$result['total'];
    }

    public function getById($eventId)
    {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
