<?php
if ($_POST) {
    $name = $_POST['name'] ?? '';
    $option = $_POST['option'] ?? '';
    $quantity = $_POST['quantity'] ?? 1;
    
    echo "<h3>Selected Option:</h3>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Option: " . htmlspecialchars($option) . "<br>";
    echo "Quantity: " . htmlspecialchars($quantity) . "<br>";
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Your Name" required><br><br>
    <select name="option" required>
        <option value="">Choose Option</option>
        <option value="basic">Basic</option>
        <option value="premium">Premium</option>
        <option value="deluxe">Deluxe</option>
    </select><br><br>
    <input type="number" name="quantity" value="1" min="1" required><br><br>
    <input type="submit" value="Select Option">
</form>
