<?php
require_once __DIR__ . '/../components/auth_check.php';
require_once __DIR__ . '/../src/Event.php';
require_once __DIR__ . '/../src/helpers.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        $date = $_POST['date'];
        // Validate date format
        if (!DateTime::createFromFormat('Y-m-d\TH:i', $date)) {
            throw new Exception("Invalid date/time format. Use: YYYY-MM-DD HH:MM");
        }
        $event = new Event();
        $event->create(
            sanitizeInput($_POST['title']),
            sanitizeInput($_POST['description']),
            $date,
            sanitizeInput($_POST['location']),
            (int)$_POST['capacity'],
            $_SESSION['user_id']
        );
        header("Location: " . BASE_URL . "/public/index.php");
        exit();
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

require_once __DIR__ . '/../components/header.php';
?>

<div class="container mt-4">
    <h2>Create New Event</h2>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Date and Time</label>
                <input type="datetime-local" name="date" class="form-control"
                    value="<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : '' ?>"
                    required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Location</label>
                <input type="text" name="location" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacity</label>
            <input type="number" name="capacity" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Event</button>
    </form>
</div>

<?php require_once __DIR__ . '/../components/footer.php'; ?>