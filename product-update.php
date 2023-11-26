<?php
// include './core.php';

// if (isset($_POST["updateTovar"])) {
//     if ($find_return) { 
//         $query = "DELETE FROM `products` WHERE `id` = '$product_id'";
//         $result = mysqli_query($mysqli, $query);
//         echo 'Файл успешно обновлен.';
//     } else echo 'Файл с указаным id не найден.';
// }
include './core.php';

$product_id = $_POST["id"];
$find_id = "SELECT `id` FROM `products` WHERE `id` = '$product_id'";
$find_result = mysqli_query($mysqli, $find_id);
$find_return = $find_result->fetch_assoc() ? true : false;

// if (isset($_POST["updateTovar"])) {
    if ($find_return) {
        if ($_FILES['img__file']['full_path']){
            if('image' == substr($_FILES['img__file']['type'], 0, 5)){
                $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $img = $_FILES['img__file'];
                $description = $_POST['description'];
                    $guarantee = $_POST['guarantee'];
                    $model = $_POST['model'];
                    $release_year = $_POST['release_year'];
                    $diagonal = $_POST['diagonal'];
                    // разрешение
                    $resolution = $_POST['resolution'];
                    $model_id = $_POST['model_id'];
                $name_img = uniqid().'.'.substr($img['type'], 6);
                move_uploaded_file($img['tmp_name'], 'assets/img/'.$name_img);
                // $query = "DELETE FROM `products` WHERE `id` = '$product_id'";
                $query = "UPDATE `products` SET `name`= '$name',`price`= '$price',`description`= '$description',`img`= '$name_img',`guarantee`='$guarantee',`model`='$model',`model_id`='$model_id',`release_year`='$release_year',`diagonal`='$diagonal',`resolution`='$resolution' WHERE `id` = $id";
                $result = mysqli_query($mysqli, $query);
                header("Location: " . $_SERVER['HTTP_REFERER']);
                // print_r($query);
            }else{
                $_SESSION['errors_addTovar']['add_file'] = 'Не изображение';
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
        }else{
            $id = $_POST['id'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                // $img = $_FILES['img__file'];
                $description = $_POST['description'];
                    $guarantee = $_POST['guarantee'];
                    $model = $_POST['model'];
                    $release_year = $_POST['release_year'];
                    $diagonal = $_POST['diagonal'];
                    // разрешение
                    $resolution = $_POST['resolution'];
                    $model_id = $_POST['model_id'];
                // $name_img = uniqid().'.'.substr($img['type'], 6);
                // move_uploaded_file($img['tmp_name'], 'assets/img/'.$name_img);
                // $query = "DELETE FROM `products` WHERE `id` = '$product_id'";
                $query = "UPDATE `products` SET `name`= '$name',`price`= '$price',`description`= '$description',`guarantee`='$guarantee',`model`='$model',`model_id`='$model_id',`release_year`='$release_year',`diagonal`='$diagonal',`resolution`='$resolution' WHERE `id` = $id";
                $result = mysqli_query($mysqli, $query);
                header("Location: " . $_SERVER['HTTP_REFERER']);
                // print_r($query);
            }
    } else {
        $_SESSION['errors_deleteTovar'] = 'Товара под таким id не найдено!';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
// }
