<?php
if ($_POST) {
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $title = $_POST['title'] ?? '';
    $format = $_POST['format'] ?? '';
    
    $full_name = trim($title . ' ' . $first_name . ' ' . $last_name);
    
    echo "<h3>Name Processing:</h3>";
    echo "Full Name: " . htmlspecialchars($full_name) . "<br>";
    echo "Format: " . htmlspecialchars($format) . "<br>";
}
?>

<form method="POST">
    <select name="title">
        <option value="">Select Title</option>
        <option value="Mr.">Mr.</option>
        <option value="Ms.">Ms.</option>
        <option value="Dr.">Dr.</option>
    </select><br><br>
    <input type="text" name="first_name" placeholder="First Name" required><br><br>
    <input type="text" name="last_name" placeholder="Last Name" required><br><br>
    <input type="radio" name="format" value="formal" required> Formal
    <input type="radio" name="format" value="casual"> Casual<br><br>
    <input type="submit" value="Process Name">
</form>
