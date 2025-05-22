<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoidBound</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>VoidBound</h1>
        
        <div class="form-card1">
            <div class="form-card2">
                <div class="actions">
                    <a href="add.php" class="btn">Add New Game</a>
                </div>

                <div class="search-container">
                    <form action="" method="GET">
                        <input type="text" name="search" placeholder="Search games..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

                        <select name="genre">
                            <option value="">All Genres</option>
                            <?php
                            $genres = $pdo->query("SELECT DISTINCT genre FROM games ORDER BY genre");
                            while ($g = $genres->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (isset($_GET['genre']) && $_GET['genre'] === $g['genre']) ? 'selected' : '';
                                echo "<option value=\"{$g['genre']}\" $selected>{$g['genre']}</option>";
                            }
                            ?>
                        </select>

                        <select name="platform">
                            <option value="">All Platforms</option>
                            <?php
                            $platforms = $pdo->query("SELECT DISTINCT platform FROM games ORDER BY platform");
                            while ($p = $platforms->fetch(PDO::FETCH_ASSOC)) {
                                $selected = (isset($_GET['platform']) && $_GET['platform'] === $p['platform']) ? 'selected' : '';
                                echo "<option value=\"{$p['platform']}\" $selected>{$p['platform']}</option>";
                            }
                            ?>
                        </select>

                        <button type="submit" class="btn">Filter</button>
                    </form>
                </div>

                <?php
                $conditions = [];
                $params = [];

                if (!empty($_GET['search'])) {
                    $conditions[] = "(title LIKE :search OR developer LIKE :search OR platform LIKE :search OR genre LIKE :search OR release_date LIKE :search)";
                    $params[':search'] = "%" . trim($_GET['search']) . "%";
                }

                if (!empty($_GET['genre'])) {
                    $conditions[] = "genre = :genre";
                    $params[':genre'] = $_GET['genre'];
                }

                if (!empty($_GET['platform'])) {
                    $conditions[] = "platform = :platform";
                    $params[':platform'] = $_GET['platform'];
                }

                $sql = "SELECT * FROM games";
                if ($conditions) {
                    $sql .= " WHERE " . implode(" AND ", $conditions);
                }
                $sql .= " ORDER BY title";

                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Developer</th>
                            <th>Platform</th>
                            <th>Genre</th>
                            <th>Release Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $link = "view.php?id={$row['id']}";
                            echo "<tr class='clickable-row' data-href='view.php?id={$row['id']}'>";
                            echo "<td>{$row['title']}</td>";
                            echo "<td>{$row['developer']}</td>";
                            echo "<td>{$row['platform']}</td>";
                            echo "<td>{$row['genre']}</td>";
                            echo "<td>{$row['release_date']}</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<!-- tiny script here -->
<script>
    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
        });
    });
</script>

</html>