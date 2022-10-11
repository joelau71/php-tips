<?php
    $dbms = 'mysql';
    $host = 'localhost';
    $dbName = "test";
    $user = 'root';
    $pass = '';
    $dsn = "$dbms:host=$host; dbname=$dbName";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

    $sql = "SELECT * FROM products";
    if (!empty($_GET['search'])){
        $sql = "SELECT * FROM products WHERE productName LIKE '%{$_GET['search']}%'";
    }
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
    <title>Search 2</title>
</head>
<body>
    <div class="container mx-auto px-8">
        <form class="my-6 text-center" method="GET" action="">
            <input type="text" class="border w-96" id="search" name="search" value="<?php if(isset($_GET["search"])) echo $_GET['search']; ?>" />
            <button class="ml-4 bg-gray-400 rounded px-6" type="submit">Search</button>
            <button class="ml-4 bg-gray-400 rounded px-6" type="submit" onclick="document.getElementById('search').value=''">Clear</button>
        </form>
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
        <?php if(count($products) <= 0): ?>
            <div class="text-red-400 text-center font-bold">No Result</div>
        <?php endif; ?>
    </div>
</body>
</html>