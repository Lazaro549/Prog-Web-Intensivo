<?php
require_once 'protect.php';
require_once 'roles.php';

// Require admin role
requireRole('admin');

$message = '';
$error = '';

// Handle role change
if ($_POST && $_POST['action'] === 'change_role') {
    $user_id = $_POST['user_id'] ?? 0;
    $new_role = $_POST['new_role'] ?? '';
    
    $validation_errors = validateInput($_POST, [
        'user_id' => ['required' => true],
        'new_role' => ['required' => true]
    ]);
    
    if (empty($validation_errors) && in_array($new_role, ['user', 'moderator', 'admin'])) {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$new_role, $user_id]);
        $message = "User role updated successfully";
    } else {
        $error = "Invalid role change request";
    }
}

// Handle user deletion
if ($_POST && $_POST['action'] === 'delete_user') {
    $user_id = $_POST['user_id'] ?? 0;
    
    if ($user_id != $_SESSION['user_id']) { // Can't delete self
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $message = "User deleted successfully";
    } else {
        $error = "Cannot delete your own account";
    }
}

// Get all users
$stmt = $pdo->query("SELECT * FROM users ORDER BY role DESC, username");
$users = $stmt->fetchAll();

// Get system statistics
$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$total_users = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'admin'");
$admin_count = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM login_attempts WHERE success = 1 AND attempt_time > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$daily_logins = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>🔧 Admin Panel</h1>
        
        <?php if ($message): ?>
            <div style="color: green; background: #d4edda; padding: 10px; border-radius: 4px; margin: 10px 0;"><?= $message ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 4px; margin: 10px 0;"><?= $error ?></div>
        <?php endif; ?>
        
        <!-- System Statistics -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0;">
            <div style="background: #007bff; color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3><?= $total_users ?></h3>
                <p>Total Users</p>
            </div>
            <div style="background: #dc3545; color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3><?= $admin_count ?></h3>
                <p>Administrators</p>
            </div>
            <div style="background: #28a745; color: white; padding: 20px; border-radius: 8px; text-align: center;">
                <h3><?= $daily_logins ?></h3>
                <p>Daily Logins</p>
            </div>
        </div>
        
        <!-- User Management -->
        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 20px 0;">
            <h2>👥 User Management</h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">ID</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Username</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Email</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Role</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Created</th>
                        <th style="padding: 12px; text-align: left; border: 1px solid #ddd;">Actions</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td style="padding: 12px; border: 1px solid #ddd;"><?= $user['id'] ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;"><?= sanitize($user['username']) ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;"><?= sanitize($user['email']) ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <span class="role-badge <?= $user['role'] ?>-badge"><?= ucfirst($user['role']) ?></span>
                            </td>
                            <td style="padding: 12px; border: 1px solid #ddd;"><?= date('M j, Y', strtotime($user['created_at'])) ?></td>
                            <td style="padding: 12px; border: 1px solid #ddd;">
                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                    <form method="POST" style="display: inline-block; margin-right: 10px;">
                                        <input type="hidden" name="action" value="change_role">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <select name="new_role" onchange="this.form.submit()" style="padding: 4px;">
                                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                            <option value="moderator" <?= $user['role'] === 'moderator' ? 'selected' : '' ?>>Moderator</option>
                                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                    </form>
                                    <form method="POST" style="display: inline-block;" onsubmit="return confirm('Delete this user?')">
                                        <input type="hidden" name="action" value="delete_user">
                                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 4px 8px; border-radius: 4px; cursor: pointer;">Delete</button>
                                    </form>
                                <?php else: ?>
                                    <span style="color: #6c757d;">Current User</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>