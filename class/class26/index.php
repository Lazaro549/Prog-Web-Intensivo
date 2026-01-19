<?php
require_once 'conection.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>App Home</title>
</head>
<body>
    <h1>Welcome to the App</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p>Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
        <a href="principal.php">Go to Dashboard</a> | 
        <a href="exit.php">Logout</a>
    <?php else: ?>
        <p>Please login to access the app.</p>
        <a href="login.php">Login</a>
    <?php endif; ?>
    
    <h2>App Features</h2>
    <ul>
        <li>User Authentication</li>
        <li>Protected Dashboard</li>
        <li>Session Management</li>
    </ul>
</body>
</html>