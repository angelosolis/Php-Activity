<?php
    require_once "includes/config.inc.php";

    if (isset($_GET['logout'])) {
        session_start();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if (!isset($_SESSION['username'])) {
        header("Location: ../it-elec2/login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Home</title>
</head>

<body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
    
        <?php
        
    if (isset($_SESSION['username'])) {
        echo "<h4>Welcome, " . $_SESSION['username'] . "!</h4>";
    }
    ?>
    <br />

    <form method="POST" action="search.php">
        <input type="text" name="search" placeholder="Enter username">
        <button type="submit">Search</button>
    </form>



</body>

</html>


