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
        <div class="form-card1">
            <div class="form-card2">
                <h1><?= htmlspecialchars($game['title']) ?></h1>
                
                <div class="game-details">
                    <?php if ($game['cover_image']): ?>
                        <div class="game-cover">
                            <img src="assets/<?= $game['cover_image'] ?>" alt="<?= htmlspecialchars($game['title']) ?> Cover">
                        </div>
                    <?php endif; ?>
                    
                    <div class="game-info">
                        <p><strong>Developer:</strong> <?= htmlspecialchars($game['developer']) ?></p>
                        <?php if ($game['publisher']): ?>
                            <p><strong>Publisher:</strong> <?= htmlspecialchars($game['publisher']) ?></p>
                        <?php endif; ?>
                        <?php if ($game['release_date']): ?>
                            <p><strong>Release Date:</strong> <?= date('F j, Y', strtotime($game['release_date'])) ?></p>
                        <?php endif; ?>
                        <p><strong>Genre:</strong> <?= htmlspecialchars($game['genre']) ?></p>
                        <p><strong>Platform:</strong> <?= htmlspecialchars($game['platform']) ?></p>
                        <?php if ($game['description']): ?>
                            <div class="game-description">
                                <h3>Description</h3>
                                <p><?= nl2br(htmlspecialchars($game['description'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="actions">
                    <a href="edit.php?id=<?= $id ?>" class="btn">Edit</a>
                    <a href="index.php" class="btn">Back to Library</a>
                    <a href="delete.php?id=<?= $id ?>" class="btn danger" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>