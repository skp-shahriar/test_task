<?php
require_once __DIR__ . '/../components/auth_check.php';
require_once __DIR__ . '/../src/Event.php';
require_once __DIR__ . '/../src/helpers.php';

$eventId = (int)$_GET['id'];
$event = (new Event())->getById($eventId);

// Authorization: Only event creator can edit
if ($_SESSION['user_id'] != $event['created_by'] && !User::isAdmin()) {
    header("Location: " . BASE_URL . "/public/index.php");
    exit();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $date = $_POST['date'];
        // Validate date format
        if (!DateTime::createFromFormat('Y-m-d\TH:i', $date)) {
            throw new Exception("Invalid date/time format. Use: YYYY-MM-DD HH:MM");
        }
        $eventObj = new Event();
        $success = $eventObj->update(
            $eventId,
            sanitizeInput($_POST['title']),
            sanitizeInput($_POST['description']),
            $date,
            sanitizeInput($_POST['location']),
            (int)$_POST['capacity']
        );

        if ($success) {
            header("Location: " . BASE_URL . "/public/index.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once __DIR__ . '/../components/header.php';
?>

<div class="container mt-4">
    <h2>Edit Event</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control"
                value="<?= htmlspecialchars($event['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?=
                                                                        htmlspecialchars($event['description'])
                                                                        ?></textarea>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Date and Time</label>
                <input type="datetime-local" name="date" class="form-control"
                    value="<?= date('Y-m-d\TH:i', strtotime($event['date'] ?? 'now')) ?>"
                    required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control"
                    value="<?= htmlspecialchars($event['location']) ?>" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control"
                value="<?= $event['capacity'] ?>" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Event</button>
    </form>
</div>

<?php require_once __DIR__ . '/../components/footer.php'; ?>