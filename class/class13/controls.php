<?php
if ($_POST) {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $active = $_POST['active'] ?? '';
    $mode = $_POST['mode'] ?? '';
    $comments = $_POST['comments'] ?? '';
    
    echo "<h3>Control Settings:</h3>";
    echo "Name: " . htmlspecialchars($name) . "<br>";
    echo "Category: " . htmlspecialchars($category) . "<br>";
    echo "Active: " . ($active ? 'Yes' : 'No') . "<br>";
    echo "Mode: " . htmlspecialchars($mode) . "<br>";
    echo "Comments: " . htmlspecialchars($comments) . "<br>";
}
?>

<form method="POST">
    <input type="text" name="name" placeholder="Control Name" required><br><br>
    <select name="category" required>
        <option value="">Select Category</option>
        <option value="system">System</option>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>
    <input type="checkbox" name="active" value="1"> Active<br><br>
    <input type="radio" name="mode" value="auto" required> Automatic
    <input type="radio" name="mode" value="manual"> Manual<br><br>
    <textarea name="comments" placeholder="Comments"></textarea><br><br>
    <input type="submit" value="Save Controls">
</form>