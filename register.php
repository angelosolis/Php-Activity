<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registration</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php
    if (isset($_SESSION['username'])) {
        echo '<a href="index.php">Home</a> |';
        echo '<a href="comments.php">Comments</a> |';
        echo '<a href="index.php?logout=true">Logout</a>';
    } else {
        echo '<a href="register.php">Register</a> | ';
        echo '<a href="login.php">Login</a>';
    }
    ?>

    <form action="includes/register.inc.php" method="post">
        <div class="form-group">
        <label for="username">Username</label>
            <input type="text" class="form-control <?php if(isset($_SESSION['errors']['username'])) echo 'is-invalid'?>" name="username" placeholder="Username" value="<?= isset($_SESSION['inputs']['username']) ? $_SESSION['inputs']['username'] : '' ?>" <?php if (isset($_SESSION['errors']['username'])) echo 'style="border-color: red;"'; ?> />
            <?php if (isset($_SESSION['errors']['username'])) echo '<p style="color: red;">' . $_SESSION['errors']['username'] . '</p>'; ?>
        </div>

        <div class="form-group">
        <label for="password">Password</label>
            <input type="password" class="form-control <?php if(isset($_SESSION['errors']['username'])) echo 'is-invalid'?>" name="pwd" placeholder="Password" <?php if (isset($_SESSION['errors']['pwd'])) echo 'style="border-color: red;"'; ?> />
            <?php if (isset($_SESSION['errors']['pwd'])) echo '<p style="color: red;">' . $_SESSION['errors']['pwd'] . '</p>'; ?>
        </div>

        <div class="form-group">
        <label for="email">Email</label>
            <input type="text" class="form-control <?php if(isset($_SESSION['errors']['username'])) echo 'is-invalid'?>" name="email" placeholder="E-mail" value="<?= isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : '' ?>" <?php if (isset($_SESSION['errors']['email'])) echo 'style="border-color: red;"'; ?> />
            <?php if (isset($_SESSION['errors']['email'])) echo '<p style="color: red;">' . $_SESSION['errors']['email'] .'</p>'; ?>
        </div>

        <?php if(isset($_SESSION['reg_success'])) echo '<p style="color: green;">' . $_SESSION['reg_success'] . '</p>';?>
        <button class="btn btn-primary">Signup</button>
    </form>

    <?php
    if (isset($_SESSION['errors'])) 
    {
        unset($_SESSION['inputs']);
        unset($_SESSION['errors']);
    }
    unset($_SESSION['reg_success']);
    ?>
</body>

</html>