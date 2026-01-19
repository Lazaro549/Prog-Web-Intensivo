<?php
if ($_POST) {
    $limit = $_POST['limit'] ?? 10;
    $direction = $_POST['direction'] ?? 'up';
    
    echo "<h3>Count Result:</h3>";
    if ($direction == 'up') {
        for ($i = 1; $i <= $limit; $i++) {
            echo "$i ";
        }
    } else {
        for ($i = $limit; $i >= 1; $i--) {
            echo "$i ";
        }
    }
}
?>

<form method="POST">
    <input type="number" name="limit" placeholder="Count to" value="10" required><br><br>
    <select name="direction" required>
        <option value="up">Count Up</option>
        <option value="down">Count Down</option>
    </select><br><br>
    <input type="submit" value="Start Count">
</form>
