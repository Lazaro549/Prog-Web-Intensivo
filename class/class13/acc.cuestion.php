<?php
if ($_POST) {
    $account_type = $_POST['account_type'] ?? '';
    $balance = $_POST['balance'] ?? '';
    $interest = $_POST['interest'] ?? '';
    $notifications = $_POST['notifications'] ?? '';
    
    echo "<h3>Account Setup:</h3>";
    echo "Type: " . htmlspecialchars($account_type) . "<br>";
    echo "Initial Balance: $" . htmlspecialchars($balance) . "<br>";
    echo "Interest: " . ($interest ? 'Yes' : 'No') . "<br>";
    echo "Notifications: " . htmlspecialchars($notifications) . "<br>";
}
?>

<form method="POST">
    <select name="account_type" required>
        <option value="">Account Type</option>
        <option value="checking">Checking</option>
        <option value="savings">Savings</option>
    </select><br><br>
    <input type="number" name="balance" placeholder="Initial Balance" required><br><br>
    <input type="checkbox" name="interest" value="1"> Enable Interest<br><br>
    <input type="radio" name="notifications" value="email" required> Email
    <input type="radio" name="notifications" value="sms"> SMS<br><br>
    <input type="submit" value="Create Account">
</form>