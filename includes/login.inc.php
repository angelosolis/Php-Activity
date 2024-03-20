<?php
session_start();
require_once "config.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try 
    {
        require_once "dbc.inc.php";
        $query = "SELECT * FROM users WHERE username = :username";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $pdo = null;
        $stmt = null;
    } 
    catch (PDOException $e) 
    {
        die("Query failed: " . $e->getMessage());
    }  

    if ($user) 
    {
        if (password_verify($pwd, $user['pwd'])) 
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: ../index.php");
            exit();
        } 
        else 
        {
            $_SESSION['login_error'] = "Incorrect Credentials!";
            header("Location: ../login.php");
            exit();
        }
    } 
    else 
    {
        $_SESSION['login_error'] = "Incorrect Credentials!";
        header("Location: ../login.php");
        exit();
    }
} 
else 
{
    header("Location: ../index.php");
}
?>