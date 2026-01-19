<?php
// Get greeting data from URL parameters
$name = $_GET['name'] ?? 'Guest';
$message = $_GET['message'] ?? 'Welcome';

echo htmlspecialchars($message) . ", " . htmlspecialchars($name) . "!";
?>
