<?php
require_once 'protect.php';

// Get user info
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$current_user = $stmt->fetch();

// Get recent login attempts
$stmt = $pdo->prepare("SELECT * FROM login_attempts WHERE username = ? ORDER BY attempt_time DESC LIMIT 5");
$stmt->execute([$_SESSION['username']]);
$recent_attempts = $stmt->fetchAll();

// Get user statistics
$stmt = $pdo->prepare("SELECT COUNT(*) as total_logins FROM login_attempts WHERE username = ? AND success = 1");
$stmt->execute([$_SESSION['username']]);
$total_logins = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) as failed_attempts FROM login_attempts WHERE username = ? AND success = 0");
$stmt->execute([$_SESSION['username']]);
$failed_attempts = $stmt->fetchColumn();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <h1>Dashboard</h1>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin: 20px 0;">
            <!-- User Info Card -->
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2>👤 Account Information</h2>
                <p><strong>User ID:</strong> <?= $_SESSION['user_id'] ?></p>
                <p><strong>Username:</strong> <?= htmlspecialchars($_SESSION['username']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($current_user['email']) ?></p>
                <p><strong>Account Created:</strong> <?= date('M j, Y', strtotime($current_user['created_at'])) ?></p>
            </div>
            
            <!-- Session Info Card -->
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2>🕑 Session Information</h2>
                <p><strong>Login Time:</strong> <?= date('M j, Y H:i:s', $_SESSION['login_time']) ?></p>
                <p><strong>Last Activity:</strong> <?= date('M j, Y H:i:s', $_SESSION['last_activity']) ?></p>
                <p><strong>Session Expires:</strong> <?= date('M j, Y H:i:s', $_SESSION['login_time'] + 1800) ?></p>
                <p><strong>Time Remaining:</strong> <span id="countdown"></span></p>
            </div>
            
            <!-- Statistics Card -->
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <h2>📊 User Statistics</h2>
                <p><strong>Total Successful Logins:</strong> <?= $total_logins ?></p>
                <p><strong>Failed Login Attempts:</strong> <?= $failed_attempts ?></p>
                <p><strong>Success Rate:</strong> <?= $total_logins > 0 ? round(($total_logins / ($total_logins + $failed_attempts)) * 100, 1) : 0 ?>%</p>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0;">
            <h2>⚡ Quick Actions</h2>
            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                <a href="profile.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Edit Profile</a>
                <a href="settings.php" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Settings</a>
                <a href="#" onclick="location.reload()" style="background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Refresh</a>
            </div>
        </div>
        
        <!-- Recent Login Attempts -->
        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 20px 0;">
            <h2>📋 Recent Login Attempts</h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <tr style="background: #f8f9fa;">
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Time</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">IP Address</th>
                        <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Status</th>
                    </tr>
                    <?php foreach ($recent_attempts as $attempt): ?>
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ddd;"><?= date('M j, Y H:i:s', strtotime($attempt['attempt_time'])) ?></td>
                            <td style="padding: 10px; border: 1px solid #ddd;"><?= htmlspecialchars($attempt['ip_address']) ?></td>
                            <td style="padding: 10px; border: 1px solid #ddd;">
                                <?php if ($attempt['success'] == 1): ?>
                                    <span style="color: green; font-weight: bold;">✓ Success</span>
                                <?php elseif ($attempt['success'] == 2): ?>
                                    <span style="color: blue; font-weight: bold;">→ Logout</span>
                                <?php else: ?>
                                    <span style="color: red; font-weight: bold;">✗ Failed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
    
    <script>
    // Session countdown timer
    function updateCountdown() {
        const loginTime = <?= $_SESSION['login_time'] ?>;
        const sessionTimeout = 1800; // 30 minutes
        const now = Math.floor(Date.now() / 1000);
        const remaining = (loginTime + sessionTimeout) - now;
        
        if (remaining > 0) {
            const minutes = Math.floor(remaining / 60);
            const seconds = remaining % 60;
            document.getElementById('countdown').textContent = minutes + 'm ' + seconds + 's';
        } else {
            document.getElementById('countdown').textContent = 'Expired';
            document.getElementById('countdown').style.color = 'red';
        }
    }
    
    updateCountdown();
    setInterval(updateCountdown, 1000);
    </script>
</body>
</html>
