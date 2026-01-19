<?php
// Get result data from URL parameters
$name = $_GET['name'] ?? 'Unknown';
$score = $_GET['score'] ?? 0;
$status = $_GET['status'] ?? 'Pending';

echo "Name: " . htmlspecialchars($name) . "<br>";
echo "Score: " . htmlspecialchars($score) . "<br>";
echo "Status: " . htmlspecialchars($status) . "<br>";
?>