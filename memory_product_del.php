<?php
include './core.php';
if (isset($_POST["delMemory"])) {
    $idColor = $_POST["idColor"];
    $query = "DELETE FROM `product_memory` WHERE `id` = '$idColor'";
    $result = mysqli_query($mysqli, $query);
    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>