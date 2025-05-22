<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = ?");
$stmt->execute([$id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($game['title']) ?> - Game Details</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="game-showcase">
            <div class="game-header">
                <h1><?= htmlspecialchars($game['title']) ?></h1>
                <div class="game-meta">
                    <span class="platform-badge"><?= htmlspecialchars($game['platform']) ?></span>
                    <span class="genre-badge"><?= htmlspecialchars($game['genre']) ?></span>
                </div>
            </div>
            
            <div class="game-content">
                <div class="game-details">
                    <div class="detail-section">
                        <h2>Game Information</h2>
                        <div class="info-grid">
                            <div class="info-item">
                                <label>Developer</label>
                                <span><?= htmlspecialchars($game['developer']) ?></span>
                            </div>
                            
                            <?php if ($game['publisher']): ?>
                            <div class="info-item">
                                <label>Publisher</label>
                                <span><?= htmlspecialchars($game['publisher']) ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($game['release_date']): ?>
                            <div class="info-item">
                                <label>Release Date</label>
                                <span><?= date('F j, Y', strtotime($game['release_date'])) ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <div class="info-item">
                                <label>Platform</label>
                                <span><?= htmlspecialchars($game['platform']) ?></span>
                            </div>
                            
                            <div class="info-item">
                                <label>Genre</label>
                                <span><?= htmlspecialchars($game['genre']) ?></span>
                            </div>
                        </div>
                    </div>

                    <?php if ($game['description']): ?>
                    <div class="detail-section">
                        <h2>Description</h2>
                        <div class="game-description">
                            <?= nl2br(htmlspecialchars($game['description'])) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="actions">
                <a href="edit.php?id=<?= $id ?>" class="btn">Edit Game</a>
                <a href="index.php" class="btn">Back to Library</a>
                <a href="delete.php?id=<?= $id ?>" class="btn danger" onclick="return confirm('Are you sure you want to delete this game?')">Delete Game</a>
            </div>
        </div>
    </div>
</body>
</html>