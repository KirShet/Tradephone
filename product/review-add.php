<?php
include '../core.php';
if(isset($_POST["modal-add"])){

    foreach($_POST as $key => $value){
        if($key!="modal-add"){
            if(empty($value)){
                $_SESSION['errors_modal-add'][$key] = ' Поле под именем '.$key.' не заполнено';
            }
        }
    }
    $name = $_POST['modal-name'];
    $review_desc = $_POST['modal-text'];
    $review_point = $_POST['product_point'];
    $product_id = $_POST['product_id'];
    $review = $mysqli->query( 
        "INSERT INTO `reviews` 
        (`product_id`, `name`, `description`, `point`) VALUES 
        ('$product_id', '$name', '$review_desc', '$review_point')
            ");
    $reviewsProduct = $mysqli->query( 
        "UPDATE `products` SET 
        `point` = (`point`+'$review_point'), `count_reviews` = (`count_reviews`+1) WHERE `id` = '$product_id'");
    header('location: ../product.php');
}
?>