<?php
    $products = json_decode(file_get_contents("https://fakestoreapi.com/products"));
    $filterProducts = [];
    if (isset($_POST['search'])) {
        foreach ($products as $product)
        if (str_contains(strtolower($product->title), strtolower($_POST['search']))) {
            $filterProducts[] = $product;
        }
    } else {
        $filterProducts = $products;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="container mx-auto px-8">
        <form class="my-6 text-center" method="POST" action="">
            <input type="text" class="border w-96" id="search" name="search" value="<?php if(isset($_POST["search"])) echo $_POST['search']; ?>" />
            <button class="ml-4 bg-gray-400 rounded px-6" type="submit">Search</button>
            <button class="ml-4 bg-gray-400 rounded px-6" type="submit" onclick="document.getElementById('search').value=''">Clear</button>
        </form>
        <div class="flex flex-wrap">
            <?php foreach ($filterProducts as $product): ?>
                <div class="w-1/5 p-4">
                    <div class="border p-4 h-full rounded">
                        <div class="h-32 overflow relative">
                            <img class="absolute h-full object-fit left-1/2 -translate-x-1/2" src="<?php echo $product->image; ?>" alt="">
                        </div>
                        <div class="text-center mt-4">
                            <?php echo $product->title; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>