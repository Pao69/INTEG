<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// First, get the game to check for cover image
$stmt = $pdo->prepare("SELECT cover_image FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if ($game) {
    // Delete the cover image if it exists
    if ($game['cover_image'] && file_exists("assets/{$game['cover_image']}")) {
        unlink("assets/{$game['cover_image']}");
    }
    
    // Delete the game record
    $stmt = $pdo->prepare("DELETE FROM games WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>