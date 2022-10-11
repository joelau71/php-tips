<?php
    $dbms = 'mysql';
    $host = 'localhost';
    $dbName = "test";
    $user = 'root';
    $pass = '';
    $dsn = "$dbms:host=$host; dbname=$dbName";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT * FROM orders o INNER JOIN orderdetails od ON o.orderNumber = od.orderNumber";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll();
    echo json_encode($orders);
    die;
?>