<?php
include '../core.php';

session_start();

if ($_SESSION['admin'] !== true) {
    header('Location: index.php');
}
// if ($_GET['id']) {
//     $products = $mysqli->query("SELECT * FROM products WHERE id = '{$_GET['id']}'");
  //  // $find_return = $products->fetch_assoc() ? true : false;
//     if ($products->num_rows == 0) {
//         $_SESSION['errors_updateTovar'] = 'Товара под таким id не найдено!';
//         header("Location: " . $_SERVER['HTTP_REFERER']);
//     }
//     $product = $products->fetch_assoc();
// }
$colr = mysqli_query($mysqli, "SELECT * FROM `makes`");
 // добавление цвета
 if(isset($_POST['addColor'])) {
    $color = $_POST['nameColor'];

    mysqli_query($mysqli, "INSERT INTO `makes`(`model`) VALUES ('$color')");
    //     mysqli_query($mysqli, "INSERT INTO `colors`(`id`, `color`) VALUES (NULL, '$color')");
    header("Location: " . $_SERVER['HTTP_REFERER']);
 }

 // удаление цвета
 if(isset($_POST['delColor'])) {
    $delColr = $_POST['idColor'];
    
    mysqli_query($mysqli, "DELETE FROM `makes` WHERE `id` = '$delColr'");
    header("Location: " . $_SERVER['HTTP_REFERER']);
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <title>Редактор</title>
</head>

<body>
    <?php
    include('../header_products.php')
        ?>
    <main class="main">
        <div class="container">
            <div class="main-admin-block__h">
                <h1>Привет, Админ. Проверь корзину: там <font color="#C14231"> N </font> товара(ов)</h1>
            </div>
            <div class="main-admin-block-a">
                <div class="main-admin-block__p">
                    <p>Закончили с изменениями?</p>
                </div>
                <div class="main-admin-block__exit">
                    <a href="../admin_panel.php" id="exit">В админ панель</a>
                </div>
            </div>

            <form action="makes.php" method="post" style="max-width: 1000px; margin: 0 auto;">
                <div class="main-admin-block-update" id="update_Tovar" style=" margin-top: 50px; display: flex; justify-content: center;">
                    <div class="main-admin-update-inputs" style="margin: 0;">
                        <div class="main-admin-update-inputs-newName">
                            <input type="text" id="nameColor" name="nameColor" placeholder="Количество памяти" value = "666" required>
                        </div>
                        <div class="main-admin-block-right-updateTovar">
                            <button id="addColor" name="addColor">Добавить товар</button>
                        </div>
                    </div>
                </div>
            </form>

<div style="max-width: 500px; margin: 0 auto;">
      <?php 
         while($row_color = mysqli_fetch_assoc($colr)) {
            ?>
            <form action="makes.php" method="post">
               <div class="cell" style="display: flex; align-items: center; justify-content: space-between; font-size: 20px; margin-bottom: 25px; border: 1px solid #C14231; padding: 5px; border-radius: 5px;">
               <input id="idColor" name="idColor" type="text" value="<?php echo $row_color['id'] ?>" hidden>
               <div style="display: flex; align-items: center; gap: 10px;">
               <!-- <div class="circle-color" style="width: 25px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.25); border-radius: 50%; background-color: red;"></div> -->
               <?php echo $row_color['model'].' ГБ'; ?>
               </div>
               <button id="delColor" name="delColor" type="submit" style="background-color: #C14231; border-radius: 5px; padding: 5px; color: white;">Удалить</button>
               </div>
            </form>
            <?php 
         }
      ?>
</div>

        </div>
    </main>
</body>
</html>