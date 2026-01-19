<?php
if ($_POST) {
    $action = $_POST['action'] ?? '';
    $priority = $_POST['priority'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    $schedule = $_POST['schedule'] ?? '';
    
    echo "<h3>Action Submitted:</h3>";
    echo "Action: " . htmlspecialchars($action) . "<br>";
    echo "Priority: " . htmlspecialchars($priority) . "<br>";
    echo "Confirmed: " . ($confirm ? 'Yes' : 'No') . "<br>";
    echo "Schedule: " . htmlspecialchars($schedule) . "<br>";
}
?>

<form method="POST">
    <input type="text" name="action" placeholder="Action Description" required><br><br>
    <select name="priority" required>
        <option value="">Priority Level</option>
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
    </select><br><br>
    <input type="checkbox" name="confirm" value="1"> Confirm Action<br><br>
    <input type="radio" name="schedule" value="now" required> Execute Now
    <input type="radio" name="schedule" value="later"> Schedule Later<br><br>
    <input type="submit" value="Submit Action">
</form>