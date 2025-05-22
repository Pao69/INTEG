<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $developer = $_POST['developer'];
    $publisher = $_POST['publisher'];
    $release_date = $_POST['release_date'];
    $genre = $_POST['genre'];
    $platform = $_POST['platform'];
    $description = $_POST['description'];
    
    // Handle file upload
    $cover_image = '';
    if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'assets/';
        $fileName = uniqid() . '_' . basename($_FILES['cover_image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $targetPath)) {
            $cover_image = $fileName;
        }
    }
    
    $stmt = $pdo->prepare("INSERT INTO games (title, developer, publisher, release_date, genre, platform, description, cover_image) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $developer, $publisher, $release_date, $genre, $platform, $description, $cover_image]);
    
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
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="form-card1">
            <div class="form-card2">
                <h1>Add New Game</h1>
                <form action="add.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">Title*</label>
                        <input type="text" id="title" name="title" class="input-field" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="developer">Developer*</label>
                        <input type="text" id="developer" name="developer" class="input-field" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" id="publisher" name="publisher" class="input-field">
                    </div>
                    
                    <div class="form-group">
                        <label for="release_date">Release Date</label>
                        <input type="date" id="release_date" name="release_date" class="input-field">
                    </div>
                    
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
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" class="input-field"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="cover_image">Cover Image</label>
                        <input type="file" id="cover_image" name="cover_image" accept="image/*" class="input-field">
                    </div>
                    
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