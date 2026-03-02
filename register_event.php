<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];

try {
    $stmt = $pdo->prepare(
        "INSERT INTO event_registrations (user_id, event_id) 
         VALUES (:user_id, :event_id)"
    );
    $stmt->execute([
        'user_id' => $user_id,
        'event_id' => $event_id
    ]);

    header("Location: events.php?success=registered");
} catch (PDOException $e) {
    // Duplicate registration
    header("Location: events.php?error=already_registered");
}
