<?php
include './core.php';
if (isset($_POST["delColor"])) {
    $idColor = $_POST["idColor"];
    $query = "DELETE FROM `product_colors` WHERE `id` = '$idColor'";
    $result = mysqli_query($mysqli, $query);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>