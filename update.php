<?php
    session_start();

    require_once "config.php";
    
    if (!empty($_POST['id'])) {
        $sql = "UPDATE list SET title = :title, complete = :complete WHERE id = :id";
        $data = [
            "id" => (int) $_POST['id'],
            "title" => $_POST["title"],
            "complete" => (int) $_POST['complete'],
        ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }
    $_SESSION['message'] = "Update todo success.";
    header("Location: /test/index.php");