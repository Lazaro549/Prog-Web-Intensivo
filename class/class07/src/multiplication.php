<?php
// Get multiplication data from URL parameters
$num1 = $_GET['num1'] ?? 1;
$num2 = $_GET['num2'] ?? 1;
$result = $num1 * $num2;

echo "Number 1: " . htmlspecialchars($num1) . "<br>";
echo "Number 2: " . htmlspecialchars($num2) . "<br>";
echo "Result: " . htmlspecialchars($result) . "<br>";
?>
