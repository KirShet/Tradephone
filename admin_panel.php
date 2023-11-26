<?php
include 'core.php';

session_start();
if ($_SESSION['admin'] !== true) {
    header('Location: index.php');
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
    include('./header.php')
        ?>
    <main class="main">
        <div class="container">
            <div class="main-admin-block__h">
                <h1>Привет, Админ. Проверь корзину: там <font color="#C14231"> N </font> товара(ов)</h1>
            </div>
            <div class="main-admin-block-a">
                <div class="main-admin-block__p">
                    <p>Что-то поменялось? Воспользуйся следующими функциями:</p>
                </div>
                <div class="main-admin-block__a">
                    <a href="#add_Tovar">Добавить товар</a>
                    <a href="#delete_Tovar">Удалить товар</a>
                    <a href="#update_Tovar">Обновить товар</a>
                    <a href="/product/color.php">Цвет</a>
                    <a href="/product/memory.php">Память</a>
                    <a href="/product/makes.php">Модель</a>
                </div>
            </div>
            <div class="main-admin-block-a">
                <div class="main-admin-block__p">
                    <p>Закончили с изменениями?</p>
                </div>
                <div class="main-admin-block__exit">
                    <a href="./logout.php" id="exit">Выход</a>

                </div>
            </div>

            <form action="product-add.php" method="POST" enctype="multipart/form-data">
                <div class="main-admin-block-inputs" id="add_Tovar">
                    <div class="main-admin-block-inputs-block">
                        <div class="main-admin-block__p_h">
                            <p>Добавление товара</p>
                        </div>
                    </div>

                    <div class="main-admin-block-right">
                    <p style="color:red"><?php
                     ?></p><br>
                    <p style="color:red">
                    <?php
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
                            <input type="text" name="name" placeholder="Название">
                        </div>
                        <!-- ГАРАНТИЯ -->
                        <div class="main-admin-block__input-name">
                            <br>
                            <input type="text" name="guarantee" id="guarantee" placeholder="Гарантия" required>
                        </div>
                        <!-- МОДЕЛЬ -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="model" id="model" placeholder="Модель" required>
                        </div>
                        <!-- ГОД РЕЛИЗА -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="release_year" id="release_year" placeholder="Год релиза" required>
                        </div>
                        <!-- ДИАГОНАЛЬ (ДЮЙМЫ) -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="diagonal" id="diagonal" placeholder="Диагональ (дюймы)" required>
                        </div>
                        <!-- РАЗРЕШЕНИЕ -->
                        <div class="main-admin-block__input-name">
                        <br>
                            <input type="text" name="resolution" id="resolution" placeholder="Разрешение экрана" required>
                        </div>
                        <!--  -->
                        <div class="main-admin-block-right-cost">
                            <input type="number" placeholder="Цена" id="cost" name=" price" required>
                        </div>
                        <div class="main-admin-block-right__textarea">
                            <textarea name="description" id="description" placeholder="Описание" required></textarea>
                        </div>
                        <?php 
                            $models = mysqli_query($mysqli, "SELECT * FROM `makes`");
                        ?>
                        <p style="font-size: 20px; margin-top: 10px; ">Выберите модель</p>
                        <select name="model_id" style="width: 100px; height: 30px; margin-top: 20px;">
                        <?php 
                            foreach($models as $keyModel => $valueModel):
                        ?>
                        <option value="<?= $valueModel['id']?>"><?= $valueModel['model']?></option>
                        <?php 
                            endforeach;
                        ?>
                        </select>
                        <div class="main-admin-block-right-img__p">
                            <p>Изображения</p>
                        </div>
                        <div class="main-admin-block-right-img__input">
                            <input type="file" id="img__file" name="img__file">
                        </div>
                        <div class="main-admin-block-right-addTovar">
                            <button id="addTovar" name="addTovar">Добавить товар</button>
                        </div>
                    </div>

                </div>
            </form>

            <form action="product-remove.php" method="POST">
                <div class="main-admin-block-delete" id="delete_Tovar">
                    <div class="main-admin-block-delete__p">
                        <p> Удалить товар</p>
                        <?php
                        if(isset($_SESSION['errors_deleteTovar'])){
                            echo "<p style='color:red;font-size: 20px'>".$_SESSION['errors_deleteTovar']."</p>";
                        }
                        unset($_SESSION['errors_deleteTovar']);
                    ?>
                    </div>
                    <div class="main-admin-block-delete__input">
                        <input type="number" placeholder="id товара" name="id">
                    </div>
                </div>

                <div class="main-admin-block-delete__button">
                    <button id="deleteTovar" name="deleteTovar">Удалить товар</button>
                </div>
            </form>

            <form action="form-update.php" method="GET">
                <div class="main-admin-block-update" id="update_Tovar">
                    <div class="main-admin-update-p">
                        <div class="main-admin-update__p">
                            <p>Обновить товар</p>
                        </div>
                    </div>
                    <div class="main-admin-update-inputs">
                        <div class="main-admin-update-inputs-id">
                        <?php
                        if(isset($_SESSION['errors_updateTovar'])){
                                echo "<p style='color:red;font-size: 20px'>".$_SESSION['errors_updateTovar']."</p>";
                            }
                            unset($_SESSION['errors_updateTovar']);
                        ?>
                            <input type="text" id="id" name="id" placeholder="id товара" required>
                        </div>
                        
                        <div class="main-admin-block-right-updateTovar">
                            <button id="fillForm" name="fillForm">Обновить товар</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </main>
</body>

</html>