<?php
require_once 'config.inc.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    $_SESSION['inputs'] = [
        'username' => $username,
        'pwd' => $pwd,
        'email' => $email
    ];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = "Invalid email address.";
    }
    if (empty($email)) {
        $_SESSION['errors']['email'] = "Email address is a required field.";
    }
    if (empty($username)) {
        $_SESSION['errors']['username'] = "Username is a required field.";
    }
    if (empty($pwd)) {
        $_SESSION['errors']['pwd'] = "Password is a required field.";
    }

    if (isset($_SESSION['errors'])) {
        header("Location: ../register.php");
        exit();
    }
    
    try {
        require_once "dbc.inc.php";
        $hashedpassword = password_hash($pwd, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :hashedpassword, :email);";

        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":hashedpassword", $hashedpassword);
        $stmt->bindParam(":email", $email);

        $stmt->execute();

        $pdo = null;
        $stmt = null;

        $_SESSION['reg_success'] = "You have registered successfully.";
        unset($_SESSION['inputs']);
        header("Location: ../register.php");
        exit();
    } 
    
    catch (PDOException $e) 
    {
        die("Query failed: " . $e->getMessage());
    }   
} 
else 
{
    header("Location: ../register.php");
    exit();
}