<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];

    try {
        require_once "includes/dbc.inc.php";

        $query = "SELECT c.*, u.username FROM comments AS c
                  INNER JOIN users AS u ON c.user_id = u.id
                  WHERE u.username LIKE :search";

        $stmt = $pdo->prepare($query);

        $searchTerm = "%$search%";
        $stmt->bindParam(":search", $searchTerm, PDO::PARAM_STR);

        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h3>Search Results:</h3>

    <?php if (empty($results)) : ?>
        <div>
            <p>There were no results!</p>
        </div>
    <?php else : ?>
        <?php foreach ($results as $row) : ?>
            <h2><?= htmlspecialchars($row['username']) ?></h2>
            <p><?= htmlspecialchars($row['comments']) ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>