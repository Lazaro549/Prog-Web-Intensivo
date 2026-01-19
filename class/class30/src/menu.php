<?php
// Check if user is logged in for menu display
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? $_SESSION['username'] : '';
$user_role = '';

// Get user role if logged in
if ($is_logged_in) {
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user_data = $stmt->fetch();
    $user_role = $user_data['role'] ?? 'user';
}
?>

<style>
.menu-bar {
    background: #333;
    padding: 10px 0;
    margin-bottom: 20px;
}
.menu-bar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.menu-bar li {
    display: inline;
}
.menu-bar a {
    color: white;
    text-decoration: none;
    padding: 10px 15px;
    border-radius: 4px;
}
.menu-bar a:hover {
    background: #555;
}
.menu-user {
    color: white;
    font-weight: bold;
}
.menu-left, .menu-right {
    display: flex;
    gap: 10px;
}
.role-badge {
    background: #007bff;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    margin-left: 5px;
}
.admin-badge { background: #dc3545; }
.moderator-badge { background: #ffc107; color: #000; }
</style>

<nav class="menu-bar">
    <ul>
        <div class="menu-left">
            <li><a href="index.php">Home</a></li>
            <?php if ($is_logged_in): ?>
                <li><a href="principal.php">Dashboard</a></li>
                <li><a href="myaccount.php">My Account</a></li>
                <?php if ($user_role === 'admin'): ?>
                    <li><a href="admin.php">Admin Panel</a></li>
                <?php endif; ?>
                <?php if ($user_role === 'admin' || $user_role === 'moderator'): ?>
                    <li><a href="manage.php">Manage Users</a></li>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        
        <div class="menu-right">
            <?php if ($is_logged_in): ?>
                <li class="menu-user">
                    Welcome, <?= htmlspecialchars($username) ?>
                    <span class="role-badge <?= $user_role ?>-badge"><?= ucfirst($user_role) ?></span>
                </li>
                <li><a href="exit.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </div>
    </ul>
</nav>