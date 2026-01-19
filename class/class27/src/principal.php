<?php
require_once 'protect.php';

// Get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$current_user = $stmt->fetch();

// Get recent login attempts
$stmt = $pdo->prepare("SELECT * FROM login_attempts WHERE username = ? ORDER BY attempt_time DESC LIMIT 5");
$stmt->execute([$_SESSION['username']]);
$recent_attempts = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
    
    <h2>Your Account Info</h2>
    <p>User ID: <?= $_SESSION['user_id'] ?></p>
    <p>Username: <?= htmlspecialchars($_SESSION['username']) ?></p>
    <p>Email: <?= htmlspecialchars($current_user['email']) ?></p>
    <p>Account Created: <?= $current_user['created_at'] ?></p>
    
    <h2>Session Info</h2>
    <p>Login Time: <?= date('Y-m-d H:i:s', $_SESSION['login_time']) ?></p>
    <p>Last Activity: <?= date('Y-m-d H:i:s', $_SESSION['last_activity']) ?></p>
    <p>Session Expires: <?= date('Y-m-d H:i:s', $_SESSION['login_time'] + 1800) ?></p>
    
    <h2>Recent Login Attempts</h2>
    <table border="1">
        <tr><th>Time</th><th>IP Address</th><th>Status</th></tr>
        <?php foreach ($recent_attempts as $attempt): ?>
            <tr>
                <td><?= $attempt['attempt_time'] ?></td>
                <td><?= htmlspecialchars($attempt['ip_address']) ?></td>
                <td><?= $attempt['success'] ? 'Success' : 'Failed' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <h2>App Functions</h2>
    <ul>
        <li>View Profile</li>
        <li>Settings</li>
        <li>Reports</li>
        <li>Data Management</li>
    </ul>
    
    <h2>Navigation</h2>
    <a href="index.php">Home</a> | 
    <a href="exit.php">Logout</a>
</body>
</html>
