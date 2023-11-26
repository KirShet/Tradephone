<?php
include './core.php';
if (!isset($_SESSION['admin'])) {
    header("Location: /");
}
if ($_GET['id']) {
    $products = $mysqli->query("SELECT * FROM products WHERE id = '{$_GET['id']}'");
    if ($products->num_rows == 0) {
        $_SESSION['errors']['update'] = 'Такого товара нет!';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    $product = $products->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="product_update.php" method="post">
        <div class="main-admin-update-inputs-newName">
            <input type="text" id="nameUpdate" name="nameUpdate" value="<?= $product['name'] ?>">
        </div>
        <div class="main-admin-update-inputs-newCost">
            <input type="text" id="costUpdate" name="costUpdate" value="<?= $product['price'] ?>">
        </div>
        <div class="main-admin-update-inputs-newDescription">
            <textarea name="descriptionUpdate" id="descriptionUpdate" value="<?= $product['description'] ?>"></textarea>
        </div>
    </form>
</body>

</html>