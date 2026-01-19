<?php
require_once 'protect.php';

$message = '';
$error = '';

// Get current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

// Handle profile update
if ($_POST && $_POST['action'] === 'update_profile') {
    $email = $_POST['email'] ?? '';
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    
    if ($email) {
        // Verify current password if changing password
        if ($new_password && !password_verify($current_password, $user['password'])) {
            $error = 'Current password is incorrect';
        } else {
            // Update email and optionally password
            if ($new_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET email = ?, password = ? WHERE id = ?");
                $stmt->execute([$email, $hashed_password, $_SESSION['user_id']]);
                $message = 'Profile and password updated successfully';
            } else {
                $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
                $stmt->execute([$email, $_SESSION['user_id']]);
                $message = 'Profile updated successfully';
            }
            
            // Refresh user data
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch();
        }
    }
}

// Get account statistics
$stmt = $pdo->prepare("SELECT COUNT(*) as total_logins FROM login_attempts WHERE username = ? AND success = 1");
$stmt->execute([$user['username']]);
$total_logins = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT attempt_time FROM login_attempts WHERE username = ? AND success = 1 ORDER BY attempt_time DESC LIMIT 1");
$stmt->execute([$user['username']]);
$last_login = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="max-width: 800px; margin: 0 auto; padding: 0 20px;">
        <h1>My Account</h1>
        
        <?php if ($message): ?>
            <div style="color: green; background: #d4edda; padding: 10px; border-radius: 4px; margin: 10px 0;"><?= $message ?></div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 4px; margin: 10px 0;"><?= $error ?></div>
        <?php endif; ?>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 20px; margin: 20px 0;">
            <!-- Account Information -->
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2>👤 Account Information</h2>
                <div style="margin: 15px 0;">
                    <strong>Username:</strong> <?= htmlspecialchars($user['username']) ?>
                    <span class="role-badge <?= $user['role'] ?>-badge" style="margin-left: 10px;"><?= ucfirst($user['role']) ?></span>
                </div>
                <div style="margin: 15px 0;"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></div>
                <div style="margin: 15px 0;"><strong>Account Created:</strong> <?= date('M j, Y', strtotime($user['created_at'])) ?></div>
                <div style="margin: 15px 0;"><strong>User ID:</strong> <?= $user['id'] ?></div>
            </div>
            
            <!-- Account Statistics -->
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2>📊 Account Statistics</h2>
                <div style="margin: 15px 0;"><strong>Total Logins:</strong> <?= $total_logins ?></div>
                <div style="margin: 15px 0;"><strong>Last Login:</strong> <?= $last_login ? date('M j, Y H:i:s', strtotime($last_login)) : 'Never' ?></div>
                <div style="margin: 15px 0;"><strong>Account Status:</strong> <span style="color: green;">Active</span></div>
                <div style="margin: 15px 0;"><strong>Role Permissions:</strong>
                    <?php if ($user['role'] === 'admin'): ?>
                        <span style="color: #dc3545;">Full System Access</span>
                    <?php elseif ($user['role'] === 'moderator'): ?>
                        <span style="color: #ffc107;">User Management</span>
                    <?php else: ?>
                        <span style="color: #007bff;">Standard User</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Update Profile Form -->
        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 20px 0;">
            <h2>✏️ Update Profile</h2>
            <form method="POST">
                <input type="hidden" name="action" value="update_profile">
                
                <div style="margin: 15px 0;">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                
                <div style="margin: 15px 0;">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">Current Password (required to change password):</label>
                    <input type="password" name="current_password" placeholder="Enter current password to change password"
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                
                <div style="margin: 15px 0;">
                    <label style="display: block; margin-bottom: 5px; font-weight: bold;">New Password (leave blank to keep current):</label>
                    <input type="password" name="new_password" placeholder="Enter new password (optional)"
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                
                <button type="submit" style="background: #007bff; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; font-size: 16px;">
                    Update Profile
                </button>
            </form>
        </div>
        
        <!-- Role Information -->
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h2>🔐 Role Information</h2>
            <p><strong>Current Role:</strong> <?= ucfirst($user['role']) ?></p>
            
            <?php if ($user['role'] === 'admin'): ?>
                <div style="color: #dc3545;">
                    <h4>Administrator Privileges:</h4>
                    <ul>
                        <li>Full system access</li>
                        <li>User management</li>
                        <li>Role assignment</li>
                        <li>System configuration</li>
                        <li>View all user data</li>
                    </ul>
                </div>
            <?php elseif ($user['role'] === 'moderator'): ?>
                <div style="color: #ffc107;">
                    <h4>Moderator Privileges:</h4>
                    <ul>
                        <li>User management</li>
                        <li>Content moderation</li>
                        <li>View user reports</li>
                        <li>Limited system access</li>
                    </ul>
                </div>
            <?php else: ?>
                <div style="color: #007bff;">
                    <h4>Standard User Privileges:</h4>
                    <ul>
                        <li>Access personal dashboard</li>
                        <li>Update own profile</li>
                        <li>View own data</li>
                        <li>Basic app features</li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
