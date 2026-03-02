<?php
session_start();
require_once 'config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    
    if (!empty($student_id) && !empty($email) && !empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (student_id, email, password_hash, first_name, last_name) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$student_id, $email, $password_hash, $first_name, $last_name])) {
            $success = 'Registration successful! You can now login.';
        } else {
            $error = 'Registration failed.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - CampusConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <h1>🎓 Create Account</h1>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?> <a href="login.php">Login</a></div>
            <?php endif; ?>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" name="student_id" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
</body>
</html>