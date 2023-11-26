<?php
include './core.php';

session_start();

// $product_colors = $mysqli->query("SELECT * FROM products WHERE id = '{$_GET['id']}'");
$colr = mysqli_query($mysqli, "SELECT * FROM `colors`");
$color_results = mysqli_fetch_all($colr, MYSQLI_ASSOC);
// 
$memr = mysqli_query($mysqli, "SELECT * FROM `memory`");
$memory_results = mysqli_fetch_all($memr, MYSQLI_ASSOC);

if ($_SESSION['admin'] !== true) {
    header('Location: index.php');
}
if ($_GET['id']) {
    $products = $mysqli->query("SELECT * FROM products WHERE id = '{$_GET['id']}'");
    // $find_return = $products->fetch_assoc() ? true : false;
    if ($products->num_rows == 0) {
        $_SESSION['errors_updateTovar'] = 'Товара под таким id не найдено!';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    $product = $products->fetch_assoc();

    // вывод цветов которые уже присоеденены к табл
    $color_product = mysqli_query($mysqli, "SELECT `colors`.*, `product_colors`.*
    FROM `product_colors` 
        LEFT JOIN `colors` ON `product_colors`.`color_id` = `colors`.`id`
     WHERE `product_colors`.`product_id` = '{$_GET['id']}'");
        $colr_prod = mysqli_fetch_all($color_product, MYSQLI_ASSOC);
    // $color_product = mysqli_query($mysqli, $query);

    // вывод памяти которая уже присоеденена к табл
    $memory_product = mysqli_query($mysqli, "SELECT `memory`.*, `product_memory`.*
    FROM `product_memory` 
        LEFT JOIN `memory` ON `product_memory`.`memory_id` = `memory`.`id`
    WHERE `product_memory`.`product_id` = '{$_GET['id']}'");
        $memr_prod = mysqli_fetch_all($memory_product, MYSQLI_ASSOC);
    // $color_product = mysqli_query($mysqli, $query);
}
// INSERT INTO `product_colors`(`product_id`, `color_id`) VALUES ('$product_id','$color_id')
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
    include('./header.php')
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
                    <a href="./admin_panel.php" id="exit">В админ панель</a>

                </div>
            </div>
            <form action="product-update.php" method="POST" enctype="multipart/form-data">
                <div class="main-admin-block-inputs" id="add_Tovar">
                    <div class="main-admin-block-inputs-block">
                        <div class="main-admin-block__p_h">
                            <p>Обновление товара</p>
                        </div>
                    </div>

                    <div class="main-admin-block-right">
                    <p style="color:red"><?php
                    //  if(isset($_SESSION['errors_addTovar'])) echo $_SESSION['errors_addTovar']; unset($_SESSION['errors_addTovar']) 
                     ?></p><br>
                    <p style="color:red">
                    <?php
                    if(isset($_SESSION['errors_deleteTovar'])){       
                        echo "<p style='color:red; font-size: 20px'>". $_SESSION['errors_deleteTovar'] ."</p>";
                        unset($_SESSION['errors_deleteTovar']);
                    }

                    if(isset($_SESSION['errors_addTovar'])){
                        foreach ($_SESSION['errors_addTovar'] as $key => $value){
                            if($value!="addTovar"){
                                echo "<p style='color:red; font-size: 20px'>$value</p>";
                            }
                        }
                        unset($_SESSION['errors_addTovar']);
                    }
                    ?>
                    </p><br>
                        <div class="main-admin-block__input-name">
                            <input type="text" name="name" placeholder="Название" value="<?= $product['name'] ?>">
                        </div>
                        <!-- <div class="main-admin-block-right-ROM">
                        <p>Встроенная память (ROM)</p>
                    </div>
                    <div class="main-admin-block-right-ROM__input">
                        <input type="checkbox" id="ROM1" name="ROM1" value="1">
                        <label for="ROM1">32GB</label>
                        <input type="checkbox" id="ROM2" name="ROM2" value="2">
                        <label for="ROM2">64GB</label>
                        <input type="checkbox" id="ROM3" name="ROM3">
                        <label for="ROM3">128GB</label>
                        <input type="checkbox" id="ROM4" name="ROM4">
                        <label for="ROM4">256GB</label>
                    </div> -->
                        <!-- ГАРАНТИЯ -->
                        <div class="main-admin-block__input-name">
                            <br>
                            <input type="text" name="guarantee" id="guarantee" value="<?= $product['guarantee'] ?>" placeholder="Гарантия" required>
                        </div>
                        <!-- МОДЕЛЬ -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="model" id="model" value="<?= $product['model'] ?>" placeholder="Модель" required>
                        </div>
                        <!-- ГОД РЕЛИЗА -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="release_year" id="release_year" value="<?= $product['release_year'] ?>" placeholder="Год релиза" required>
                        </div>
                        <!-- ДИАГОНАЛЬ (ДЮЙМЫ) -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="diagonal" id="diagonal" value="<?= $product['diagonal'] ?>" placeholder="Диагональ (дюймы)" required>
                        </div>
                        <!-- РАЗРЕШЕНИЕ -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="resolution" id="resolution" value="<?= $product['resolution'] ?>" placeholder="Разрешение экрана" required>
                        </div>
                        <!--  -->
                        <div class="main-admin-block-right-cost">
                            <input type="number" placeholder="Цена" id="cost" name="price" value="<?= $product['price'] ?>" required>
                            <input type="hidden" id="id" name="id" value="<?= $product['id'] ?>">
                        </div>
                        <div class="main-admin-block-right__textarea">
                            <textarea name="description" id="description" placeholder="Описание" required><?= $product['description'] ?></textarea>
                        </div>
                        <div class="main-admin-update-inputs-newCost update">
                            <?php 
                                $modelProduct = mysqli_query($mysqli, "SELECT `products`.`id`, `makes`.`id`, `makes`.`model` FROM `products` LEFT JOIN `makes` ON `products`.`model_id` = `makes`.`id` WHERE `products`.`id` = '{$_GET['id']}';");
                                $resModel = mysqli_fetch_array($modelProduct);
                                $models = mysqli_query($mysqli, "SELECT * FROM `makes`");
                            ?>
                            <p style="font-size: 18px; margin-top: 10px;">Модель:</p>
                            <select name="model_id" style="width: 100px; height: 30px; margin-top: 10px;">
                            <?php 
                                foreach($models as $keyModel => $valueModel):
                            ?>
                            <option value="<?= $valueModel['id']?>"<?=$valueModel['model']==$resModel['model']?'selected':''?>><?= $valueModel['model']?></option>
                            <?php 
                                endforeach;
                            ?>
                        </div>
                        <div class="main-admin-block-right-img__p">
                            <p>Изображения</p>
                        </div>
                        <div class="main-admin-block-right-img__input">
                            <input type="file" id="img__file" name="img__file">
                        </div>
                        <div class="main-admin-block-right-addTovar">
                            <button id="updateTovar" name="addTovar">Добавить товар</button>
                        </div>
                    </div>

                </div>
            </form>

            <form action="color_product_add.php" method="post" style="max-width: 1000px; margin: 0 auto;">
                <div class="main-admin-block-update" id="update_Tovar" style=" margin-top: 50px; display: flex; justify-content: center;">
                    <div class="main-admin-update-inputs" style="margin: 0;">
                        <div class="main-admin-update-inputs-newName">
                        <?php
                            if(isset($_SESSION['errors_col_prod_add'])){       
                                echo "<p style='color:red; font-size: 20px'>". $_SESSION['errors_col_prod_add'] ."</p>";
                                unset($_SESSION['errors_col_prod_add']);
                            }
                        ?>
                            <input type="hidden" id="product_id" name="product_id" value="<?= $product['id'] ?>" required>
                            <select name="color_id">
                                <?php foreach($color_results as $row_color):?>
                                    <option value="<?=$row_color['id'] ?>"><?=$row_color['color'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                            <?php foreach($colr_prod as $row_color):?>
                                <form action="color_product_del.php" method="post">
                                <div class="cell" style="display: flex; align-items: center; justify-content: space-between; font-size: 20px; margin-bottom: 25px; border: 1px solid #C14231; padding: 5px; border-radius: 5px; width: min-content;">
                                <input id="idColor" name="idColor" type="text" value="<?php echo $row_color['id'] ?>" hidden>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="circle-color" style="width: 25px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.25); border-radius: 50%; background-color: <?php echo $row_color['color']; ?>;"></div>
                                </div>
                                <button id="delColor" name="delColor" type="submit" style="background-color: #C14231; border-radius: 5px; padding: 5px; color: white;">Удалить</button>
                                </div>
                                </form>
                            <?php endforeach;?>
                        <div class="main-admin-block-right-updateTovar">
                            <button id="addColor" name="addColor">Добавить цвет</button>
                        </div>
                    </div>
                </div>
            </form>

            <form action="memory_product_add.php" method="post" style="max-width: 1000px; margin: 0 auto;">
                <div class="main-admin-block-update" id="update_Tovar" style=" margin-top: 50px; display: flex; justify-content: center;">
                    <div class="main-admin-update-inputs" style="margin: 0;">
                        <div class="main-admin-update-inputs-newName">
                        <?php
                            if(isset($_SESSION['errors_col_prod_add'])){       
                                echo "<p style='color:red; font-size: 20px'>". $_SESSION['errors_col_prod_add'] ."</p>";
                                unset($_SESSION['errors_col_prod_add']);
                            }
                        ?>
                            <input type="hidden" id="product_id" name="product_id" value="<?= $product['id'] ?>" required>
                            <select name="color_id">
                                <?php foreach($memory_results as $row_color):?>
                                    <option value="<?=$row_color['id'] ?>"><?=$row_color['ROM'] ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                            <?php foreach($memr_prod as $row_memory):?>
                                <form action="memory_product_del.php" method="post">
                                <div class="cell" style="display: flex; align-items: center; justify-content: space-between; font-size: 20px; margin-bottom: 25px; border: 1px solid #C14231; padding: 5px; border-radius: 5px; width: min-content;">
                                <input id="idColor" name="idColor" type="text" value="<?php echo $row_memory['id'] ?>" hidden>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                <div class="circle-color" style="width: 50px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.25);"><?php echo $row_memory['ROM']; ?>GB</div>
                                </div>
                                <button id="delMemory" name="delMemory" type="submit" style="background-color: #C14231; border-radius: 5px; padding: 5px; color: white;">Удалить</button>
                                </div>
                                </form>
                            <?php endforeach;?>
                        <div class="main-admin-block-right-updateTovar">
                            <button id="addMemory" name="addMemory">Добавить память</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </main>
</body>
</html>