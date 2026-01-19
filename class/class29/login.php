<?php
require_once 'conection.php';

$error = '';
$max_attempts = 3;
$lockout_time = 300; // 5 minutes

// Check login attempts
function checkLoginAttempts($username, $pdo) {
    global $max_attempts, $lockout_time;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM login_attempts WHERE username = ? AND attempt_time > DATE_SUB(NOW(), INTERVAL ? SECOND) AND success = FALSE");
    $stmt->execute([$username, $lockout_time]);
    return $stmt->fetchColumn() >= $max_attempts;
}

// Log login attempt
function logLoginAttempt($username, $success, $pdo) {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $stmt = $pdo->prepare("INSERT INTO login_attempts (username, ip_address, success) VALUES (?, ?, ?)");
    $stmt->execute([$username, $ip, $success]);
}

if ($_POST) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        // Check if account is locked
        if (checkLoginAttempts($username, $pdo)) {
            $error = 'Account temporarily locked due to multiple failed attempts';
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['login_time'] = time();
                $_SESSION['last_activity'] = time();
                logLoginAttempt($username, true, $pdo);
                header('Location: principal.php');
                exit;
            } else {
                logLoginAttempt($username, false, $pdo);
                $error = 'Invalid username or password';
            }
        }
    } else {
        $error = 'Please fill all fields';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="max-width: 400px; margin: 50px auto; padding: 0 20px;">
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; margin-bottom: 30px;">Login</h2>
            
            <?php if ($error): ?>
                <div style="color: #dc3545; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center;"><?= $error ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div style="margin-bottom: 20px;">
                    <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                <input type="submit" value="Login" style="width: 100%; padding: 12px; background: #007bff; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">
            </form>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="register.php" style="color: #007bff; text-decoration: none;">Don't have an account? Register</a>
            </div>
        </div>
        
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <h3 style="margin-top: 0;">Demo Accounts:</h3>
            <p style="margin: 5px 0;"><strong>admin</strong> / password</p>
            <p style="margin: 5px 0;"><strong>user1</strong> / password</p>
            <p style="margin: 5px 0;"><strong>demo</strong> / password</p>
        </div>
    </div>
</body>
</html>