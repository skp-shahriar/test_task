<?php
require_once __DIR__ . '/../components/auth_check.php';
require_once __DIR__ . '/../src/Event.php';
require_once __DIR__ . '/../src/helpers.php';

$event = new Event();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$sort = isset($_GET['sort']) ? sanitizeInput($_GET['sort']) : 'date';

$events = $event->getEvents($page, $perPage, $search, $sort);
$totalEvents = $event->getTotalEvents($search);
$totalPages = ceil($totalEvents / $perPage);

require_once __DIR__ . '/../components/header.php';
?>

<div class="container mt-4">
    <h2>Event Dashboard</h2>

    <!-- Search and Sorting -->
    <form class="mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search events..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="date" <?= $sort === 'date' ? 'selected' : '' ?>>Sort by Date</option>
                    <option value="title" <?= $sort === 'title' ? 'selected' : '' ?>>Sort by Title</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Apply</button>
            </div>
        </div>
    </form>

    <!-- Events Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Date</th>
                <th>Location</th>
                <th>Capacity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e['title']) ?></td>
                    <td><?= date('M j, Y H:i', strtotime($e['date'])) ?></td>
                    <td><?= htmlspecialchars($e['location']) ?></td>
                    <td><?= $e['capacity'] ?></td>
                    <td>
                        <a href="view_event.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-info">View</a>
                        <?php if ($_SESSION['user_id'] == $e['created_by'] || User::isAdmin()): ?>
                            <a href="edit_event.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete_event.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link"
                        href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&sort=<?= $sort ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<?php require_once __DIR__ . '/../components/footer.php'; ?>