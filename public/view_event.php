<?php
require_once __DIR__ . '/../components/auth_check.php';
require_once __DIR__ . '/../src/Event.php';
require_once __DIR__ . '/../src/Attendee.php';
require_once __DIR__ . '/../src/helpers.php';

$eventId = (int)$_GET['id'];
$event = (new Event())->getById($eventId);
$attendee = new Attendee();
$attendees = $attendee->getAttendees($eventId);

require_once __DIR__ . '/../components/header.php';
?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($event['title']) ?></h2>
    <p class="text-muted">Date: <?= date('M j, Y H:i', strtotime($event['date'])) ?></p>
    <p>Location: <?= htmlspecialchars($event['location']) ?></p>
    <p>Capacity: <?= $event['capacity'] ?></p>
    <p><?= nl2br(htmlspecialchars($event['description'])) ?></p>

    <?php
    // Check if current user is registered
    $isRegistered = false;
    foreach ($attendees as $a) {
        if ($a['user_id'] == $_SESSION['user_id']) {
            $isRegistered = true;
            break;
        }
    }
    ?>
    <?php if ($isRegistered): ?>
        <form id="leaveForm" method="POST" action="<?= BASE_URL ?>/public/leave_event.php">
            <input type="hidden" name="event_id" value="<?= $eventId ?>">
            <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
            <button type="submit" class="btn btn-danger mt-3">Leave Event</button>
        </form>
    <?php else: ?>
        <!-- Registration Form -->
        <form id="registrationForm" method="POST" action="/register_attendee.php">
            <input type="hidden" name="event_id" value="<?= $eventId ?>">
            <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
            <button type="submit" class="btn btn-primary">Register for Event</button>
        </form>
    <?php endif; ?>

    <?php
    // Show download button to event creator
    if ($_SESSION['user_id'] == $event['created_by']):
    ?>
        <a href="<?= BASE_URL ?>/reports/export_attendees.php?event_id=<?= $eventId ?>"
            class="btn btn-success mt-3">
            Download Attendee List (CSV)
        </a>
    <?php endif; ?>

    <!-- Attendees List -->
    <h4 class="mt-4">Attendees (<?= count($attendees) ?>/<?= $event['capacity'] ?>)</h4>
    <ul class="list-group">
        <?php foreach ($attendees as $a): ?>
            <li class="list-group-item">
                <?= htmlspecialchars($a['username']) ?> (<?= htmlspecialchars($a['email']) ?>)
                <span class="text-muted float-end">
                    <?= date('M j, Y', strtotime($a['registration_date'])) ?>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php require_once __DIR__ . '/../components/footer.php'; ?>

<script>
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Use dynamic BASE_URL for AJAX endpoint
        fetch("<?= BASE_URL ?>/public/register_attendee.php", {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Registration successful!');
                    location.reload(); // Refresh attendee list
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                alert('Network error. Please try again.');
            });
    });
</script>