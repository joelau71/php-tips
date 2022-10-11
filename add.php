<?php
    session_start();
    require_once "config.php";

    if (!empty($_POST['title'])) {
        $sql = "INSERT INTO list(title, complete) VALUES(:title, :complete)";
        $data = [
            "title" => $_POST['title'],
            "complete" => 0,
        ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }
    $_SESSION['message'] = "Add todo success.";
    header("Location: /test/index.php");
