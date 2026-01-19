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
</head>
<body>
    <h2>Login</h2>
    
    <?php if ($error): ?>
        <div style="color: red;"><?= $error ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <input type="submit" value="Login">
    </form>
    
    <p><a href="index.php">Back to Home</a></p>
    
    <h3>Demo Accounts (password: 'password' for all):</h3>
    <p>admin / password<br>user1 / password<br>demo / password</p>
</body>
</html>
