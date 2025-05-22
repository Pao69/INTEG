<?php
/**
 * Edit Game Page
 * Handles the form submission and display for editing existing games in the database
 */

// Include database connection
include 'db.php';

// Validate if game ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

// Fetch game details from database
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirect if game not found
if (!$game) {
    header("Location: index.php");
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $developer = $_POST['developer'];
    $publisher = $_POST['publisher'];
    $release_date = $_POST['release_date'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];
    $description = $_POST['description'];
    
    // Prepare and execute UPDATE query
    $stmt = $pdo->prepare("UPDATE games SET title = ?, developer = ?, publisher = ?, release_date = ?, 
                          genre = ?, platform = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $developer, $publisher, $release_date, $genre, $platform, $description, $id]);
    
    // Redirect to index page after successful update
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Game</title>
    <!-- Add cache-busting parameter to CSS file -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="form-card1">
            <div class="form-card2">
                <h1>Edit Game</h1>
                <!-- Game Edit Form -->
                <form action="edit.php?id=<?= $id ?>" method="post">
                    <!-- Title Field (Required) -->
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" id="title" name="title" class="input-field" value="<?= htmlspecialchars($game['title']) ?>" required>
                    </div>
                    
                    <!-- Developer Field (Required) -->
                    <div class="form-group">
                        <label for="developer">Developer*</label>
                        <input type="text" id="developer" name="developer" class="input-field" value="<?= htmlspecialchars($game['developer']) ?>" required>
                    </div>
                    
                    <!-- Publisher Field (Optional) -->
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher" class="input-field" value="<?= htmlspecialchars($game['publisher']) ?>">
                    </div>
                    
                    <!-- Release Date Field (Optional) -->
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" id="release_date" name="release_date" class="input-field" value="<?= $game['release_date'] ?>">
                    </div>
                    
                    <!-- Genre Selection (Optional) -->
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre" class="input-field">
                            <option value="Action" <?= $game['genre'] === 'Action' ? 'selected' : '' ?>>Action</option>
                            <option value="Adventure" <?= $game['genre'] === 'Adventure' ? 'selected' : '' ?>>Adventure</option>
                            <option value="RPG" <?= $game['genre'] === 'RPG' ? 'selected' : '' ?>>RPG</option>
                            <option value="Strategy" <?= $game['genre'] === 'Strategy' ? 'selected' : '' ?>>Strategy</option>
                            <option value="Sports" <?= $game['genre'] === 'Sports' ? 'selected' : '' ?>>Sports</option>
                            <option value="Puzzle" <?= $game['genre'] === 'Puzzle' ? 'selected' : '' ?>>Puzzle</option>
                            <option value="Other" <?= !in_array($game['genre'], ['Action', 'Adventure', 'RPG', 'Strategy', 'Sports', 'Puzzle']) ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    
                    <!-- Platform Selection (Optional) -->
                    <div class="form-group">
                        <label for="platform">Platform</label>
                        <select id="platform" name="platform" class="input-field">
                            <option value="PC" <?= $game['platform'] === 'PC' ? 'selected' : '' ?>>PC</option>
                            <option value="PlayStation" <?= $game['platform'] === 'PlayStation' ? 'selected' : '' ?>>PlayStation</option>
                            <option value="Xbox" <?= $game['platform'] === 'Xbox' ? 'selected' : '' ?>>Xbox</option>
                            <option value="Nintendo Switch" <?= $game['platform'] === 'Nintendo Switch' ? 'selected' : '' ?>>Nintendo Switch</option>
                            <option value="Mobile" <?= $game['platform'] === 'Mobile' ? 'selected' : '' ?>>Mobile</option>
                            <option value="Other" <?= !in_array($game['platform'], ['PC', 'PlayStation', 'Xbox', 'Nintendo Switch', 'Mobile']) ? 'selected' : '' ?>>Other</option>
                        </select>
                    </div>
                    
                    <!-- Description Field (Optional) -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="input-field"><?= htmlspecialchars($game['description']) ?></textarea>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="actions">
                        <button type="submit" class="btn">Update Game</button>
                        <a href="index.php" class="btn danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>