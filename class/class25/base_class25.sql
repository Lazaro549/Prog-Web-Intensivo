-- Create database for class25
CREATE DATABASE IF NOT EXISTS base_class25;
USE base_class25;

-- Create votes table
CREATE TABLE votes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    option_name VARCHAR(100) NOT NULL,
    vote_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    grade DECIMAL(3,1),
    subject VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample vote options
INSERT INTO votes (option_name, vote_count) VALUES 
('Pizza', 15),
('Burger', 12),
('Tacos', 8),
('Salad', 5);

-- Insert sample students
INSERT INTO students (name, grade, subject) VALUES 
('Alice Johnson', 9.5, 'Math'),
('Bob Smith', 8.7, 'Science'),
('Carol Davis', 9.2, 'History'),
('David Wilson', 7.8, 'English');