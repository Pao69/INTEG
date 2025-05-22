<?php
/**
 * Delete Game Page
 * Handles the deletion of a game from the database
 */

// Include database connection
include 'db.php';

// Validate if game ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// Get game ID from URL
$id = $_GET['id'];

// Prepare and execute DELETE query
$stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
$stmt->execute([$id]);

// Redirect back to index page after deletion
header("Location: index.php");
exit;
?>