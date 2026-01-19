<?php
require_once 'conection.php';

// Log logout activity
if (isset($_SESSION['username'])) {
    $stmt = $pdo->prepare("INSERT INTO login_attempts (username, ip_address, success) VALUES (?, ?, ?)");
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $stmt->execute([$_SESSION['username'], $ip, 2]); // 2 = logout
}

// Clear all session data
session_unset();
session_destroy();

// Start new session for message
session_start();
$_SESSION['logout_message'] = 'You have been logged out successfully';

// Redirect to home
header('Location: index.php');
exit;
?>