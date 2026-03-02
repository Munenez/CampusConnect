<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $pdo->prepare("
    SELECT e.*
    FROM events e
    JOIN event_registrations r ON e.id = r.event_id
    WHERE r.user_id = ?
    ORDER BY e.event_date ASC
");
$stmt->execute([$_SESSION['user_id']]);
$events = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Events - CampusConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>🎟 My Registered Events</h2>
<a href="dashboard.php" class="btn-back">← Back to Dashboard</a>


<?php if (count($events) === 0): ?>
    <p>You have not registered for any events.</p>
<?php endif; ?>

<div class="events-grid">
<?php foreach ($events as $event): ?>
    <div class="event-card">
        <h3><?= htmlspecialchars($event['title']); ?></h3>
        <p><?= htmlspecialchars($event['description']); ?></p>
        <p>📅 <?= date('M d, Y', strtotime($event['event_date'])); ?></p>
        <p>📍 <?= htmlspecialchars($event['location']); ?></p>
        <span class="badge-registered">✔ Registered</span>
    </div>
<?php endforeach; ?>
</div>

</body>
</html>
