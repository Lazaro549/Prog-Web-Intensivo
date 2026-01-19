<?php
require_once 'conection.php';
require_once 'roles.php';

$errors = [];
$success = '';

if ($_POST) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validation rules
    $validation_rules = [
        'username' => ['required' => true, 'min' => 3, 'max' => 50, 'username' => true],
        'email' => ['required' => true, 'email' => true],
        'password' => ['required' => true, 'min' => 6],
        'confirm_password' => ['required' => true]
    ];
    
    $errors = validateInput($_POST, $validation_rules);
    
    // Password confirmation
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }
    
    // Check if username exists
    if (!isset($errors['username']) && usernameExists($username)) {
        $errors['username'] = 'Username already exists';
    }
    
    // Check if email exists
    if (!isset($errors['email']) && emailExists($email)) {
        $errors['email'] = 'Email already exists';
    }
    
    // If no errors, create user
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, 'user')");
        
        if ($stmt->execute([$username, $hashed_password, $email])) {
            $success = 'Account created successfully! You can now login.';
        } else {
            $errors['general'] = 'Registration failed. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <div style="max-width: 400px; margin: 50px auto; padding: 0 20px;">
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="text-align: center; margin-bottom: 30px;">Register</h2>
            
            <?php if ($success): ?>
                <div style="color: green; background: #d4edda; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center;"><?= $success ?></div>
                <div style="text-align: center;">
                    <a href="login.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Go to Login</a>
                </div>
            <?php else: ?>
                <?php if (isset($errors['general'])): ?>
                    <div style="color: red; background: #f8d7da; padding: 10px; border-radius: 4px; margin-bottom: 20px; text-align: center;"><?= $errors['general'] ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div style="margin-bottom: 20px;">
                        <input type="text" name="username" placeholder="Username" value="<?= sanitize($_POST['username'] ?? '') ?>" required 
                               style="width: 100%; padding: 12px; border: 1px solid <?= isset($errors['username']) ? '#dc3545' : '#ddd' ?>; border-radius: 4px; box-sizing: border-box;">
                        <?php if (isset($errors['username'])): ?>
                            <div style="color: #dc3545; font-size: 14px; margin-top: 5px;"><?= $errors['username'] ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <input type="email" name="email" placeholder="Email" value="<?= sanitize($_POST['email'] ?? '') ?>" required 
                               style="width: 100%; padding: 12px; border: 1px solid <?= isset($errors['email']) ? '#dc3545' : '#ddd' ?>; border-radius: 4px; box-sizing: border-box;">
                        <?php if (isset($errors['email'])): ?>
                            <div style="color: #dc3545; font-size: 14px; margin-top: 5px;"><?= $errors['email'] ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <input type="password" name="password" placeholder="Password" required 
                               style="width: 100%; padding: 12px; border: 1px solid <?= isset($errors['password']) ? '#dc3545' : '#ddd' ?>; border-radius: 4px; box-sizing: border-box;">
                        <?php if (isset($errors['password'])): ?>
                            <div style="color: #dc3545; font-size: 14px; margin-top: 5px;"><?= $errors['password'] ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required 
                               style="width: 100%; padding: 12px; border: 1px solid <?= isset($errors['confirm_password']) ? '#dc3545' : '#ddd' ?>; border-radius: 4px; box-sizing: border-box;">
                        <?php if (isset($errors['confirm_password'])): ?>
                            <div style="color: #dc3545; font-size: 14px; margin-top: 5px;"><?= $errors['confirm_password'] ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <input type="submit" value="Register" style="width: 100%; padding: 12px; background: #28a745; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">
                </form>
                
                <div style="text-align: center; margin-top: 20px;">
                    <a href="login.php" style="color: #007bff; text-decoration: none;">Already have an account? Login</a>
                </div>
            <?php endif; ?>
        </div>
        
        <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-top: 20px;">
            <h3 style="margin-top: 0;">Registration Requirements:</h3>
            <ul style="margin: 0; padding-left: 20px;">
                <li>Username: 3-50 characters, letters/numbers/underscore only</li>
                <li>Email: Valid email address</li>
                <li>Password: Minimum 6 characters</li>
                <li>All new accounts start with 'User' role</li>
            </ul>
        </div>
    </div>
</body>
</html>