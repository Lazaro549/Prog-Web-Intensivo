<?php
// Get data from URL parameters
$player = $_GET['player'] ?? 'Guest';
$level = $_GET['level'] ?? 1;
$score = $_GET['score'] ?? 0;

echo "Player: " . htmlspecialchars($player) . "<br>";
echo "Level: " . htmlspecialchars($level) . "<br>";
echo "Score: " . htmlspecialchars($score) . "<br>";
?>