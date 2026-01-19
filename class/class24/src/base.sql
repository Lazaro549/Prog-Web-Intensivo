-- Create database
CREATE DATABASE IF NOT EXISTS testdb;
USE testdb;

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create brands table
CREATE TABLE brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country VARCHAR(50),
    founded_year INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample users
INSERT INTO users (name, email, password) VALUES 
('John Doe', 'john@example.com', 'password123'),
('Jane Smith', 'jane@example.com', 'password456'),
('Bob Johnson', 'bob@example.com', 'password789');

-- Insert sample brands
INSERT INTO brands (name, country, founded_year) VALUES 
('Apple', 'USA', 1976),
('Samsung', 'South Korea', 1938),
('Sony', 'Japan', 1946);
