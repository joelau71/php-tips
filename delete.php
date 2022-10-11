<?php
    session_start();
    require_once "config.php";
    
    if (!empty($_POST['id'])) {
        $sql = "DELETE FROM list WHERE id = :id";
        $data = [
            "id" => (int) $_POST['id'],
        ];
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
    }
    $_SESSION['message'] = "Delete todo success.";
    header("Location: /test/index.php");