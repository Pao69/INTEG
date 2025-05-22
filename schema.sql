-- Create the game library database
CREATE DATABASE IF NOT EXISTS game_library;
USE game_library;

-- Create the games table
CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL COMMENT 'Name of the game',
    developer VARCHAR(255) NOT NULL COMMENT 'Company/individual that developed the game',
    publisher VARCHAR(255) COMMENT 'Company that published the game',
    release_date DATE COMMENT 'Official release date of the game',
    genre ENUM('Action', 'Adventure', 'RPG', 'Strategy', 'Sports', 'Puzzle', 'Other') DEFAULT 'Other' COMMENT 'Game genre category',
    platform ENUM('PC', 'PlayStation', 'Xbox', 'Nintendo Switch', 'Mobile', 'Other') DEFAULT 'PC' COMMENT 'Gaming platform',
    description TEXT COMMENT 'Detailed description of the game',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record last update timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Stores video game information';

-- Add indexes for better query performance
CREATE INDEX idx_title ON games(title);
CREATE INDEX idx_genre ON games(genre);
CREATE INDEX idx_platform ON games(platform);
CREATE INDEX idx_release_date ON games(release_date); 