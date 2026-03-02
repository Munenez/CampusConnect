
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile - CampusConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand"><h1>🎓 CampusConnect</h1></div>
            <div class="nav-menu">
                <a href="index.html" class="nav-link">Home</a>
                <a href="events.php" class="nav-link">Events</a>
                <a href="profile.php" class="nav-link active">Profile</a>
                <a href="logout.php" class="nav-link">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container main-content">
        <div class="card">
            <div class="card-header">
                <h3>👤 Your Profile</h3>
            </div>
            <div class="card-body">
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
            </div>
        </div>
    </div>
</body>
</html>