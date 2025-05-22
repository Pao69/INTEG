<?php
/**
 * Database Configuration File
 * This file handles the connection to the MySQL database using PDO
 */

// Database connection parameters
$host = 'localhost';      // Database host (usually localhost for local development)
$dbname = 'game_library'; // Name of the database
$username = 'root';       // Database username
$password = '';           // Database password (empty for local XAMPP setup)

try {
    // Create a new PDO instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection failed: " . $e->getMessage());
}
?>