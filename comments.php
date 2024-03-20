<?php

try {
    require_once "includes/dbc.inc.php";
    require_once "includes/config.inc.php";

    if (isset($_GET['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }

    $query = "SELECT * FROM users";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <title>Comments</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    
    <?php
    if (isset($_SESSION['username'])) {
        echo '<a href="index.php">Home</a> | ';
        echo '<a href="comments.php">Comments</a> | ';
        echo '<a href="index.php?logout=true">Logout</a>';
    } else {
        echo '<a href="register.php">Register</a> |';
        echo '<a href="login.php">Login</a>';
    }
    ?>
    
    <form action="includes/comments.inc.php" method="post">
        <input type="hidden" name="user" value="<?= $_SESSION['user_id'] ?>">
        <b><?= "What's on your mind, " . $_SESSION['username'] . "?";?><br />
        <textarea name="comments"></textarea><br />
        <button type="submit">Submit</button>
    </form>

</body>

</html>