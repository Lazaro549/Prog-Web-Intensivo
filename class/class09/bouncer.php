<?php
if ($_POST) {
    $name = $_POST['name'] ?? '';
    $age = $_POST['age'] ?? 0;
    $id_type = $_POST['id_type'] ?? '';
    $vip = $_POST['vip'] ?? '';
    
    $access = ($age >= 21) ? 'GRANTED' : 'DENIED';
    
    echo "<h3>Access Check:</h3>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Age: " . htmlspecialchars($age) . "<br>";
    echo "ID Type: " . htmlspecialchars($id_type) . "<br>";
    echo "VIP: " . ($vip ? 'Yes' : 'No') . "<br>";
    echo "Access: " . $access . "<br>";
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="number" name="age" placeholder="Age" min="16" max="100" required><br><br>
    <select name="id_type" required>
        <option value="">Select ID Type</option>
        <option value="license">Driver's License</option>
        <option value="passport">Passport</option>
        <option value="state_id">State ID</option>
    </select><br><br>
    <input type="checkbox" name="vip" value="1"> VIP Member<br><br>
    <input type="submit" value="Check Access">
</form>