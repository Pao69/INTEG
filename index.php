<?php 
/**
 * Main Index Page
 * Displays the game library with search and filter functionality
 */

// Include database connection
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoidBound</title>
    <!-- Add cache-busting parameter to CSS file -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <h1>VoidBound</h1>
        
        <div class="form-card1">
            <div class="form-card2">
                <!-- Add New Game Button -->
                <div class="actions">
                    <a href="add.php" class="btn">Add New Game</a>
                </div>

                <!-- Search and Filter Form -->
                <div class="search-container">
                    <form action="" method="GET" id="searchForm">
                        <div class="search-group">
                            <!-- Search Input Field -->
                            <div class="search-input">
                                <input type="text" name="search" placeholder="Search games..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                                <button type="submit" class="btn">Search</button>
                            </div>
                            <!-- Filter Dropdowns -->
                            <div class="filter-group">
                                <!-- Genre Filter -->
                                <select name="genre" onchange="this.form.submit()">
                                    <option value="">All Genres</option>
                                    <?php
                                    // Fetch unique genres from database
                                    $genres = $pdo->query("SELECT DISTINCT genre FROM games ORDER BY genre");
                                    while ($g = $genres->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = (isset($_GET['genre']) && $_GET['genre'] === $g['genre']) ? 'selected' : '';
                                        echo "<option value=\"{$g['genre']}\" $selected>{$g['genre']}</option>";
                                    }
                                    ?>
                                </select>

                                <!-- Platform Filter -->
                                <select name="platform" onchange="this.form.submit()">
                                    <option value="">All Platforms</option>
                                    <?php
                                    // Fetch unique platforms from database
                                    $platforms = $pdo->query("SELECT DISTINCT platform FROM games ORDER BY platform");
                                    while ($p = $platforms->fetch(PDO::FETCH_ASSOC)) {
                                        $selected = (isset($_GET['platform']) && $_GET['platform'] === $p['platform']) ? 'selected' : '';
                                        echo "<option value=\"{$p['platform']}\" $selected>{$p['platform']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                // Initialize arrays for SQL conditions and parameters
                $conditions = [];
                $params = [];

                // Add search condition if search term is provided
                if (!empty($_GET['search'])) {
                    $conditions[] = "(title LIKE :search OR developer LIKE :search OR platform LIKE :search OR genre LIKE :search OR release_date LIKE :search)";
                    $params[':search'] = "%" . trim($_GET['search']) . "%";
                }

                // Add genre filter condition if selected
                if (!empty($_GET['genre'])) {
                    $conditions[] = "genre = :genre";
                    $params[':genre'] = $_GET['genre'];
                }

                // Add platform filter condition if selected
                if (!empty($_GET['platform'])) {
                    $conditions[] = "platform = :platform";
                    $params[':platform'] = $_GET['platform'];
                }

                // Build the SQL query with conditions
                $sql = "SELECT * FROM games";
                if ($conditions) {
                    $sql .= " WHERE " . implode(" AND ", $conditions);
                }
                $sql .= " ORDER BY title";

                // Prepare and execute the query
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                ?>

                <!-- Games Table -->
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
                        // Display game records
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
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

<script>
    // Add click event listeners to make table rows clickable
    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", () => {
            window.location.href = row.dataset.href;
        });
    });
</script>

</html>