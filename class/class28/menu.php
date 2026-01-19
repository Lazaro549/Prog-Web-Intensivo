<?php
// Check if user is logged in for menu display
$is_logged_in = isset($_SESSION['user_id']);
$username = $is_logged_in ? $_SESSION['username'] : '';
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
</style>

<nav class="menu-bar">
    <ul>
        <div class="menu-left">
            <li><a href="index.php">Home</a></li>
            <?php if ($is_logged_in): ?>
                <li><a href="principal.php">Dashboard</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="settings.php">Settings</a></li>
            <?php endif; ?>
        </div>
        
        <div class="menu-right">
            <?php if ($is_logged_in): ?>
                <li class="menu-user">Welcome, <?= htmlspecialchars($username) ?></li>
                <li><a href="exit.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </div>
    </ul>
</nav>