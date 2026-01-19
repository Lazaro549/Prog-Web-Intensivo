<?php
require_once 'protect.php';
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
    
    <h2>Session Info</h2>
    <p>Login Time: <?= date('Y-m-d H:i:s') ?></p>
</body>
</html>
