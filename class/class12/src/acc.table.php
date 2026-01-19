<?php
if ($_POST) {
    $account = $_POST['account'] ?? '';
    $balance = $_POST['balance'] ?? 0;
    $type = $_POST['type'] ?? '';
    
    echo "<table border='1'>";
    echo "<tr><th>Account</th><th>Balance</th><th>Type</th></tr>";
    echo "<tr><td>" . htmlspecialchars($account) . "</td><td>$" . htmlspecialchars($balance) . "</td><td>" . htmlspecialchars($type) . "</td></tr>";
    echo "</table>";
}
?>

<form method="POST">
    <input type="text" name="account" placeholder="Account Number" required><br><br>
    <input type="number" name="balance" placeholder="Balance" required><br><br>
    <select name="type" required>
        <option value="">Select Type</option>
        <option value="checking">Checking</option>
        <option value="savings">Savings</option>
    </select><br><br>
    <input type="submit" value="Add Account">
</form>
