-- Brands table operations
USE testdb;

-- Create brands table if not exists
CREATE TABLE IF NOT EXISTS brands (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    country VARCHAR(50),
    founded_year INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert additional brand data
INSERT INTO brands (name, country, founded_year) VALUES 
('Nike', 'USA', 1964),
('Adidas', 'Germany', 1949),
('Puma', 'Germany', 1948),
('Toyota', 'Japan', 1937),
('BMW', 'Germany', 1916);

-- Useful queries for brands
-- SELECT * FROM brands WHERE country = 'USA';
-- SELECT * FROM brands WHERE founded_year > 1950;
-- SELECT country, COUNT(*) as brand_count FROM brands GROUP BY country;