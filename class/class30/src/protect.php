<?php
require_once 'conection.php';
require_once 'roles.php';

// Check if user is logged in
requireLogin();

// Session timeout (30 minutes)
$timeout = 1800;
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > $timeout) {
    session_destroy();
    header('Location: login.php?timeout=1');
    exit;
}

// Verify user exists in database and get role
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit;
}

// Store user role in session for quick access
$_SESSION['user_role'] = $user['role'];

// Update last activity
$_SESSION['last_activity'] = time();
?>