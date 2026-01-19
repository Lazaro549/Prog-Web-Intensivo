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
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>Welcome to the App</h1>
        
        <?php if ($logout_message): ?>
            <div style="color: green; padding: 10px; background: #d4edda; border-radius: 4px; margin: 10px 0;"><?= $logout_message ?></div>
        <?php endif; ?>
        
        <?php if ($timeout_message): ?>
            <div style="color: orange; padding: 10px; background: #fff3cd; border-radius: 4px; margin: 10px 0;"><?= $timeout_message ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3>Dashboard Quick Access</h3>
                <p>Session active since: <?= date('Y-m-d H:i:s', $_SESSION['login_time']) ?></p>
                <a href="principal.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Go to Dashboard</a>
            </div>
        <?php else: ?>
            <div style="background: #e9ecef; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3>Get Started</h3>
                <p>Please login to access all app features.</p>
                <a href="login.php" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; margin-right: 10px;">Login</a>
                <a href="register.php" style="background: #17a2b8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Register</a>
            </div>
        <?php endif; ?>
        
        <h2>App Features</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin: 20px 0;">
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3>🔐 Security</h3>
                <ul>
                    <li>Password Hashing</li>
                    <li>Login Attempt Tracking</li>
                    <li>Session Timeout Protection</li>
                </ul>
            </div>
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3>👤 User Management</h3>
                <ul>
                    <li>User Registration</li>
                    <li>Profile Management</li>
                    <li>Activity Logging</li>
                </ul>
            </div>
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h3>📊 Dashboard</h3>
                <ul>
                    <li>User Statistics</li>
                    <li>Session Information</li>
                    <li>Login History</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>