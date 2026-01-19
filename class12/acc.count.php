<?php
if ($_POST) {
    $start = $_POST['start'] ?? 1;
    $end = $_POST['end'] ?? 10;
    $step = $_POST['step'] ?? 1;
    
    echo "<h3>Account Count:</h3>";
    for ($i = $start; $i <= $end; $i += $step) {
        echo "Account #$i<br>";
    }
}
?>

<form method="POST">
    <input type="number" name="start" placeholder="Start" value="1" required><br><br>
    <input type="number" name="end" placeholder="End" value="10" required><br><br>
    <select name="step" required>
        <option value="1">Step 1</option>
        <option value="2">Step 2</option>
        <option value="5">Step 5</option>
    </select><br><br>
    <input type="submit" value="Count Accounts">
</form>