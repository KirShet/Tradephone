<?php
include './core.php';
 // добавление цвета продукту
 if(isset($_POST['addMemory'])) {
    $product_id = $_POST['product_id'];
    $color_id = $_POST['color_id'];

    $query = "INSERT INTO `product_memory`(`product_id`, `memory_id`) VALUES ('$product_id','$color_id')";
    $result = mysqli_query($mysqli, $query); 
    if (!$result) {
        $_SESSION['errors_col_prod_add']= 'Данные не добавлены';
    }
    //     mysqli_query($mysqli, "INSERT INTO `colors`(`id`, `color`) VALUES (NULL, '$color')");
    // header("Location: " . $_SERVER['HTTP_REFERER']);
    header("Location: " . $_SERVER['HTTP_REFERER']);
 }
?>
<?php
if (isset($_POST["delMemory"])) {
    $idColor = $_POST["idColor"];
    $query = "DELETE FROM `product_memory` WHERE `id` = '$idColor'";
    $result = mysqli_query($mysqli, $query);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>