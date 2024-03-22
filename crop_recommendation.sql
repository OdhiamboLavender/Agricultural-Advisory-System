
-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS crop_recommendation_db;

-- Switch to the created database
USE crop_recommendation_db;

-- Table to store user inputs
CREATE TABLE IF NOT EXISTS user_input (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rainfall INT NOT NULL,
    soil_type VARCHAR(255) NOT NULL,
    temperature INT NOT NULL,
    soil_ph FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample user inputs
INSERT INTO user_input ( rainfall, soil_type, temperature, soil_ph)
VALUES
( 800, 'Silty', 25, 6.5),
( 600, 'Sandy', 20, 6.0),
(1000, 'Alluvial', 30, 7.0);

-- Table to store crop recommendations
CREATE TABLE IF NOT EXISTS recommendations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recommended_crop VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES user_input(id)
);

-- Insert sample crop recommendations
INSERT INTO recommendations (user_id, recommended_crop)
VALUES
(1, 'Maize'),
(2, 'Wheat'),
(1, 'Soybeans'),
(2, 'Tomatoes');

-- Table to store crops
CREATE TABLE IF NOT EXISTS crops (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    soil_type VARCHAR(255) NOT NULL,
    soil_ph_min FLOAT NOT NULL,
    soil_ph_max FLOAT NOT NULL,
    temp_min INT NOT NULL,
    temp_max INT NOT NULL,
    rainfall_min INT NOT NULL,
    rainfall_max INT NOT NULL
);

-- Insert sample crop data
INSERT INTO crops (name, soil_type, soil_ph_min, soil_ph_max, temp_min, temp_max, rainfall_min, rainfall_max)
VALUES 
    ('Carrots', 'Sandy', 6.0, 7.0, 15, 25, 450, 700),
    ('Maize', 'Sandy', 5.0, 7.0, 18, 32, 450, 700),
    ('Cabbage', 'Sandy', 5.8, 6.5, 15, 25, 450, 800),
   ('Potatoes', 'Sandy', 5.5, 6.5, 15, 20, 50, 100),
    ('Peppers', 'Sandy', 6, 7.5, 21, 29, 25, 50),
    ('Tomatoes', 'Sandy', 5.8, 6.5, 21, 27, 50, 75),
    ('Wheat', 'Silty', 6, 7.5, 15, 24, 300, 500),
    ('Barley', 'Silty', 6, 7.5, 15, 25, 400, 600),
    ('Spinach', 'Silty', 6, 7, 15, 25, 500, 750),
    ('Lettuce', 'Silty', 6, 7, 15, 20, 500, 750),
        ('Rice', 'Alluvial', 5.0, 7.0, 20, 35, 1000, 2500),
    ('Soybeans', 'Alluvial', 6.0, 7.0, 20, 30, 500, 1000),
    ('Barley', 'Sandy Loam', 6.0, 7.0, 15, 25, 300, 600),
    ('Sorghum', 'Loamy Sand', 5.5, 7.0, 25, 35, 300, 700),
    ('Sunflower', 'Sandy Loam', 6.0, 7.5, 20, 30, 500, 750),
    ('Cotton', 'Sandy Clay Loam', 6.0, 7.0, 25, 35, 500, 1000),
    ('Millet', 'Sandy Loam', 5.5, 7.0, 25, 35, 300, 600),
    ('Oats', 'Loamy Sand', 5.5, 6.5, 15, 25, 400, 700),
    ('Rye', 'Sandy Loam', 5.5, 7.0, 15, 25, 300, 600),
    ('Cassava', 'Sandy Clay Loam', 5.5, 6.5, 25, 35, 800, 1500),
    ('Lentils', 'Loamy Sand', 6.0, 7.5, 15, 25, 300, 600),
    ('Peanuts', 'Sandy Loam', 5.8, 7.2, 20, 32, 500, 800),
    ('Chickpeas', 'Loamy Sand', 6.0, 7.5, 20, 30, 400, 700),
    ('Alfalfa', 'Loamy Sand', 6.5, 8.0, 20, 30, 250, 500),
    ('Canola', 'Loamy Sand', 5.5, 7.5, 15, 25, 400, 700);

-- Table to store user details
CREATE TABLE IF NOT EXISTS user_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample user details
INSERT INTO user_details (username, password) VALUES
('Odhiambo_Lavender', '123'),
('Alice', '@123'),
('Smith', 'abc123');



