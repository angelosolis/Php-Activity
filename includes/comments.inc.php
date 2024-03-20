<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user'];
    $comments = $_POST['comments'];

    $dsn = "mysql:host=localhost;dbname=myfirstdb";
    $dbusername = "root";
    $dbpassword = "";

    try {
        $pdo = new PDO($dsn, $dbusername, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO comments (user_id, comments) VALUES (:user_id, :comments)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comments', $comments);
        $stmt->execute();

        echo "<script>alert('Comment Added Successfully. What a nice comment!'); window.location.href='../comments.php';</script>";
        exit();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
}