<?php
require_once 'conection.php';

// Check for logout message
$logout_message = '';
if (isset($_SESSION['logout_message'])) {
    $logout_message = $_SESSION['logout_message'];
    unset($_SESSION['logout_message']);
}

// Check for timeout message
$timeout_message = '';
if (isset($_GET['timeout'])) {
    $timeout_message = 'Session expired due to inactivity';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>App Home</title>
</head>
<body>
    <h1>Welcome to the App</h1>
    
    <?php if ($logout_message): ?>
        <div style="color: green;"><?= $logout_message ?></div>
    <?php endif; ?>
    
    <?php if ($timeout_message): ?>
        <div style="color: orange;"><?= $timeout_message ?></div>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
        <p>Session active since: <?= date('Y-m-d H:i:s', $_SESSION['login_time']) ?></p>
        <a href="principal.php">Go to Dashboard</a> | 
        <a href="exit.php">Logout</a>
    <?php else: ?>
        <p>Please login to access the app.</p>
        <a href="login.php">Login</a>
    <?php endif; ?>
    
    <h2>App Features</h2>
    <ul>
        <li>Secure User Authentication</li>
        <li>Password Hashing</li>
        <li>Login Attempt Tracking</li>
        <li>Session Timeout Protection</li>
        <li>Protected Dashboard</li>
        <li>Activity Logging</li>
    </ul>
</body>
</html>