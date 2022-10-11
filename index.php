<?php
    session_start();

    require_once("config.php");

    $sql ="SELECT * FROM list";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    $message = "";
    if (isset($_SESSION["message"])) {
        $message = $_SESSION["message"];
        unset($_SESSION["message"]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PHP Todo List</title>
</head>
<body>
    <?php if($message): ?>
        <div class="bg-green-400 textd-center"><?php echo $message; ?></div>
    <?php endif; ?>
    <form class="container mx-auto px-8" method="POST" action="add.php">
        <input class="border" type="text" name="title" />
        <button type="submit">Add</button>
    </form>

    <div class="mt-4 container px-8 mx-auto">
        <?php foreach($data as $item): ?>
            <div class="flex">
                <form class="flex gap-x-2 items-center" method="POST" action="update.php">
                    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
                    <input type="hidden" name="complete" value="0" />
                    <div>
                        <input type="checkbox" name="complete" value="1" <?php echo $item->complete ? 'checked' :''; ?> />
                    </div>
                    <div class="w-96">
                        <input type="text" class="w-full" name="title" value="<?php echo htmlspecialchars($item->title); ?>" />
                    </div>
                    <button>Update</button>
                </form>
                <form class="ml-2" method="POST" action="delete.php">
                    <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
                    <button>Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>



  