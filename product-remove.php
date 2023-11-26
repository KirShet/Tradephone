<?php
include './core.php';

$product_id = $_POST["id"];
$find_id = "SELECT `id` FROM `products` WHERE `id` = '$product_id'";
$find_result = mysqli_query($mysqli, $find_id);
$find_return = $find_result->fetch_assoc() ? true : false;

if (isset($_POST["deleteTovar"])) {
    if ($find_return) {
        $query = "DELETE FROM `products` WHERE `id` = '$product_id'";
        $result = mysqli_query($mysqli, $query);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['errors_deleteTovar'] = 'Товара под таким id не найдено!';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}
