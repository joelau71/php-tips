<?php
    $dbms = 'mysql';
    $host = 'localhost';
    $dbName = "test";
    $user = 'root';
    $pass = '';
    $dsn = "$dbms:host=$host; dbname=$dbName";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT COUNT(*) AS total FROM products";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetch();
    $total = $data->total;


    $page = 1;
    $perPage = 9;
    if (isset($_GET["page"])) $page = (int) $_GET["page"];
    $start = ($page - 1) * $perPage;
    $totalPage = ceil($total / $perPage);
    $end = $perPage;

    $sql ="SELECT * FROM products ORDER BY productCode Limit {$start}, {$end}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Pagination</title>
</head>
<body>
    <div class="container mx-auto px-8">
        <div class="flex flex-wrap">
            <?php foreach ($products as $product): ?>
                <div class="w-1/5 p-4">
                    <div class="border p-4 h-full rounded">
                        <h2><?php echo htmlspecialchars($product->productCode); ?></h2>
                        <div class="text-center mt-4">
                            <?php echo htmlspecialchars($product->productName); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="flex gap-x-2 justify-center items-center">
            <?php if($page > 1): ?>
                <a href="pagination.php?page=<?php echo $page - 1; ?>">prev</a>
            <?php endif; ?>
            <?php foreach(range(1, $totalPage) as $item): ?>
                <a href="pagination.php?page=<?php echo $item; ?>" class="w-6 h-6 rounded text-center<?php echo $item == $page ? ' bg-black text-white' : ' bg-gray-100'; ?>">
                    <?php echo $item; ?>
                </a>
            <?php endforeach; ?>
            <?php if ($page < $totalPage): ?>
                <a href="pagination.php?page=<?php echo $page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

