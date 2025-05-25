<?php

    // Add New Game Page
    // Handles the form submission and display for adding new games to the database
 

// Include database connection
include 'db.php';

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
    
    // Prepare and execute INSERT query
    $stmt = $pdo->prepare("INSERT INTO games (title, developer, publisher, release_date, genre, platform, description) 
                          VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $developer, $publisher, $release_date, $genre, $platform, $description]);
    
    // Redirect to index page after successful insertion
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Game</title>
    <!-- Add cache-busting parameter to CSS file -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="form-card1">
            <div class="form-card2">
                <h1>Add New Game</h1>
                <!-- Game Entry Form -->
                <form action="add.php" method="post">
                    <!-- Title Field (Required) -->
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" class="input-field" required>
                    </div>
                    
                    <!-- Developer Field (Required) -->
                    <div class="form-group">
                        <label for="developer">Developer</label>
                        <input type="text" id="developer" name="developer" class="input-field" required>
                    </div>
                    
                    <!-- Publisher Field (Optional) -->
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher" class="input-field">
                    </div>
                    
                    <!-- Release Date Field (Optional) -->
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" id="release_date" name="release_date" class="input-field">
                    </div>
                    
                    <!-- Genre Selection (Optional) -->
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select id="genre" name="genre" class="input-field">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="RPG">RPG</option>
                            <option value="Strategy">Strategy</option>
                            <option value="Sports">Sports</option>
                            <option value="Puzzle">Puzzle</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <!-- Platform Selection (Optional) -->
                    <div class="form-group">
                        <label for="platform">Platform</label>
                        <select id="platform" name="platform" class="input-field">
                            <option value="PC">PC</option>
                            <option value="PlayStation">PlayStation</option>
                            <option value="Xbox">Xbox</option>
                            <option value="Nintendo Switch">Nintendo Switch</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <!-- Description Field (Optional) -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="input-field"></textarea>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="actions">
                        <button type="submit" class="btn">Add Game</button>
                        <a href="index.php" class="btn danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>