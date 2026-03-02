<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard - CampusConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
    <div class="container">
        <div class="nav-brand">
            <h1>🎓 CampusConnect</h1>
        </div>
        <div class="nav-menu">
            <a href="dashboard.php" class="nav-link active">Dashboard</a>
            <a href="events.php" class="nav-link">Events</a>
            <a href="my_events.php" class="nav-link">My Events</a>
            <a href="profile.php" class="nav-link">Profile</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>
    </div>
</nav>

<div class="container main-content">
    <h2>👋 Welcome back!</h2>
    <p>Use the dashboard below to navigate campus activities.</p>

    <div class="dashboard-grid">
        <a href="events.php" class="dashboard-card">
            <h3>📅 Events</h3>
            <p>Browse and register for events</p>
        </a>

        <a href="my_events.php" class="dashboard-card">
            <h3>🎟 My Events</h3>
            <p>View your registered events</p>
        </a>

        <a href="profile.php" class="dashboard-card">
            <h3>👤 Profile</h3>
            <p>Manage your account</p>
        </a>
    </div>
</div>

</body>
</html>
