-- Create app database
CREATE DATABASE IF NOT EXISTS app_db;
USE app_db;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create sessions table
CREATE TABLE sessions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    session_token VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Insert sample users with hashed passwords
INSERT INTO users (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@app.com'),
('user1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user1@app.com'),
('demo', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'demo@app.com');

-- Add login attempts table for security
CREATE TABLE login_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    ip_address VARCHAR(45),
    attempt_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    success BOOLEAN DEFAULT FALSE
);