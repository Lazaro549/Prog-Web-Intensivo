<?php
require_once 'conection.php';

// Add user
if ($_POST && $_POST['name']) {
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['password']]);
    echo "User added successfully!<br>";
}

// Delete user
if ($_GET['delete']) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
    echo "User deleted!<br>";
}

// Get all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY name");
$users = $stmt->fetchAll();
?>

<h2>User Management</h2>

<h3>Add User</h3>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="submit" value="Add User">
</form>

<h3>Users List</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= $user['created_at'] ?></td>
            <td><a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Delete user?')">Delete</a></td>
        </tr>
    <?php endforeach; ?>
</table>