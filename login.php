<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <?php
    session_start();


    if (isset($_SESSION['username'])) {
        echo '<a href="index.php">Home</a> |';
        echo '<a href="comments.php">Comments</a> |';
        echo '<a href="index.php?logout=true">Logout</a>';
        header("Location: ../it-elec2/index.php");
    } else {
        echo '<a href="register.php">Register</a> | ';
        echo '<a href="login.php">Login</a>';
    }


    ?>

<form action="includes/login.inc.php" method="post" class="needs-validation" novalidate>
        <label for="username">Username</label>
            <input type="text" class="form-control <?php if (isset($_SESSION['login_error'])) echo 'is-invalid'; ?>" name="username" id="username" placeholder="Username" required>
        <label for="pwd">Password</label>
            <input type="password" class="form-control <?php if (isset($_SESSION['login_error'])) echo 'is-invalid'; ?>" name="pwd" id="pwd" placeholder="Password" required>
        <?php if (isset($_SESSION['login_error'])) { echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>'; } ?>
    <button type="submit" class="btn btn-primary">Login</button>

</form>
</body>
    <?php
    if(isset($_SESSION['login_error'])) 
    {
        unset($_SESSION['login_error']);
    }
    ?>
</html>