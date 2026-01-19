<?php
require_once 'conection.php';

// Role hierarchy levels
define('ROLE_USER', 1);
define('ROLE_MODERATOR', 2);
define('ROLE_ADMIN', 3);

// Get role level
function getRoleLevel($role) {
    switch($role) {
        case 'admin': return ROLE_ADMIN;
        case 'moderator': return ROLE_MODERATOR;
        case 'user': return ROLE_USER;
        default: return 0;
    }
}

// Check if user has required role
function hasRole($required_role) {
    if (!isset($_SESSION['user_id'])) return false;
    
    global $pdo;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user_role = $stmt->fetchColumn();
    
    return getRoleLevel($user_role) >= getRoleLevel($required_role);
}

// Require specific role or redirect
function requireRole($required_role, $redirect = 'index.php') {
    if (!hasRole($required_role)) {
        header("Location: $redirect?error=access_denied");
        exit;
    }
}

// Check if user is logged in
function requireLogin($redirect = 'login.php') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: $redirect");
        exit;
    }
}

// Get current user role
function getCurrentUserRole() {
    if (!isset($_SESSION['user_id'])) return null;
    
    global $pdo;
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    return $stmt->fetchColumn();
}

// Validate input data
function validateInput($data, $rules) {
    $errors = [];
    
    foreach ($rules as $field => $rule) {
        $value = $data[$field] ?? '';
        
        // Required validation
        if (isset($rule['required']) && $rule['required'] && empty($value)) {
            $errors[$field] = ucfirst($field) . ' is required';
            continue;
        }
        
        if (!empty($value)) {
            // Email validation
            if (isset($rule['email']) && $rule['email'] && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $errors[$field] = 'Invalid email format';
            }
            
            // Min length validation
            if (isset($rule['min']) && strlen($value) < $rule['min']) {
                $errors[$field] = ucfirst($field) . ' must be at least ' . $rule['min'] . ' characters';
            }
            
            // Max length validation
            if (isset($rule['max']) && strlen($value) > $rule['max']) {
                $errors[$field] = ucfirst($field) . ' must not exceed ' . $rule['max'] . ' characters';
            }
            
            // Username validation (alphanumeric + underscore)
            if (isset($rule['username']) && $rule['username'] && !preg_match('/^[a-zA-Z0-9_]+$/', $value)) {
                $errors[$field] = 'Username can only contain letters, numbers, and underscores';
            }
        }
    }
    
    return $errors;
}

// Sanitize output
function sanitize($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Check if username exists
function usernameExists($username, $exclude_id = null) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $params = [$username];
    
    if ($exclude_id) {
        $sql .= " AND id != ?";
        $params[] = $exclude_id;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn() > 0;
}

// Check if email exists
function emailExists($email, $exclude_id = null) {
    global $pdo;
    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    $params = [$email];
    
    if ($exclude_id) {
        $sql .= " AND id != ?";
        $params[] = $exclude_id;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchColumn() > 0;
}
?>