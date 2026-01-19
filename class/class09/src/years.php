<?php
if ($_POST) {
    $birth_year = $_POST['birth_year'] ?? '';
    $current_year = $_POST['current_year'] ?? date('Y');
    $age = $current_year - $birth_year;
    
    echo "<h3>Age Calculation:</h3>";
    echo "Birth Year: " . htmlspecialchars($birth_year) . "<br>";
    echo "Current Year: " . htmlspecialchars($current_year) . "<br>";
    echo "Age: " . htmlspecialchars($age) . " years<br>";
}
?>

<form method="POST">
    <input type="number" name="birth_year" placeholder="Birth Year" min="1900" max="<?= date('Y') ?>" required><br><br>
    <input type="number" name="current_year" value="<?= date('Y') ?>" min="1900" max="2100" required><br><br>
    <input type="checkbox" name="show_months" value="1"> Show in months<br><br>
    <input type="submit" value="Calculate Age">
</form>
