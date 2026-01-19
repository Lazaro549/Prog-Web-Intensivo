<?php
if ($_POST) {
    $number = $_POST['number'] ?? 1;
    $rows = $_POST['rows'] ?? 10;
    
    echo "<table border='1'>";
    echo "<tr><th>Multiplication</th><th>Result</th></tr>";
    for ($i = 1; $i <= $rows; $i++) {
        $result = $number * $i;
        echo "<tr><td>$number x $i</td><td>$result</td></tr>";
    }
    echo "</table>";
}
?>

<form method="POST">
    <input type="number" name="number" placeholder="Table Number" value="1" required><br><br>
    <select name="rows" required>
        <option value="5">5 Rows</option>
        <option value="10" selected>10 Rows</option>
        <option value="15">15 Rows</option>
    </select><br><br>
    <input type="submit" value="Generate Table">
</form>