<?php
include './core.php';

if (isset($_POST["addTovar"])) {
    if ($_FILES['img__file']['full_path']){
        if('image' == substr($_FILES['img__file']['type'], 0, 5)){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $imgi = $_FILES['img__file']['name'];
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
            

            foreach($_POST as $key => $value){
                if($key!="addTovar"){
                    if(empty($value)){
                        $_SESSION['errors_addTovar'][$key] = ' Поле под именем '.$key.' не заполнено';
                    }
                }
            }
            
            if(!isset($_SESSION['errors_addTovar'])){
                $query = "INSERT INTO `products`(`name`, `price`,`description`, `img`, `guarantee`, `model`, `model_id`, `release_year`, `diagonal`, `resolution`) VALUES ('$name','$price','$description','$name_img', '$guarantee', '$model', '$model_id', '$release_year', '$diagonal', '$resolution')";
                $result = mysqli_query($mysqli, $query); 
            }
            if (!$result) {
                $_SESSION['errors_addTovar']['add_file'] = 'Файл не добавлен';
            }
            header('location: ./admin_panel.php');
        }else{
            $_SESSION['errors_addTovar']['add_file'] = 'Не изображение';
            header('location: ./admin_panel.php');
        }
    }else{
        $_SESSION['errors_addTovar']['add_file'] = 'Файл не добавлен (изображение)';
        header('location: ./admin_panel.php');
    }
}
?>