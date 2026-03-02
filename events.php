<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config/database.php';

$stmt = $pdo->query("SELECT * FROM events ORDER BY event_date ASC");
$events = $stmt->fetchAll();

$registeredEvents = [];

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare(
        "SELECT event_id FROM event_registrations WHERE user_id = ?"
    );
    $stmt->execute([$_SESSION['user_id']]);
    $registeredEvents = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Events - CampusConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand"><h1>🎓 CampusConnect</h1></div>
            <div class="nav-menu">
                <a href="index.html" class="nav-link">Home</a>
                <a href="events.php" class="nav-link active">Events</a>
                <a href="login.php" class="nav-link">Login</a>
            </div>
        </div>
    </nav>

    <div class="container main-content">
        <h2>All Campus Events</h2>
        <a href="dashboard.php" class="btn-back">← Back to Dashboard</a>


        <?php if (isset($_GET['success'])): ?>
    <p class="success-msg">✅ Successfully registered for the event!</p>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <p class="error-msg">⚠️ You have already registered for this event.</p>
<?php endif; ?>

        
        <div class="events-grid">
            <?php foreach ($events as $event): ?>
                <div class="event-card">
    <div class="event-category"><?php echo htmlspecialchars($event['category']); ?></div>
    <h3><?php echo htmlspecialchars($event['title']); ?></h3>
    <p><?php echo htmlspecialchars($event['description']); ?></p>

    <div class="event-meta">
        <span>📅 <?php echo date('M d, Y', strtotime($event['event_date'])); ?></span>
        <span>⏰ <?php echo date('g:i A', strtotime($event['event_time'])); ?></span>
        <span>📍 <?php echo htmlspecialchars($event['location']); ?></span>
    </div>

    <?php if (isset($_SESSION['user_id'])): ?>

    <?php if (in_array($event['id'], $registeredEvents)): ?>
        <span class="badge-registered">✔ Registered</span>
    <?php else: ?>
        <form method="POST" action="register_event.php">
            <input type="hidden" name="event_id" value="<?= $event['id']; ?>">
            <button type="submit" class="btn-register">Register</button>
        </form>
    <?php endif; ?>

<?php else: ?>
    <p><a href="login.php">Login to register</a></p>
<?php endif; ?>

</div>

            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>