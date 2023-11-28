<?php
session_start();
include './core.php';
// SELECT `id`, `name`, `price`, `description`, `img` FROM `products`;

// $result = $mysqli->query("SELECT * FROM `products`");
// $query = "SELECT `id`, `name`, `price`, `description`, `img` FROM `products`";
// $result = mysqli_query($mysqli, $query); 
// $products = $result->fetch_assoc();
// var_dump($_GET);
if(isset($_SESSION['db_products']) && isset($_GET)){
    unset ($_SESSION['db_products']['error']);
}
// if (isset($_GET)){
    if(isset($_GET['radio_color'])){
        if(isset($where)){
            $where .= " AND `product_colors`.`color_id` = '{$_GET['radio_color']}' ";
        }else{
            // WHERE 
            $where = " WHERE `product_colors`.`color_id` = '{$_GET['radio_color']}' ";
        }
    }
    if(isset($_GET['radio_memory'])){
        if(isset($where)){
            $where .= " AND `product_memory`.`memory_id` = '{$_GET['radio_memory']}' ";
        }else{
            // WHERE 
            $where = " WHERE `product_memory`.`memory_id` = '{$_GET['radio_memory']}' ";
        }
    }
    if(isset($_GET['radio_model'])){
        if(isset($where)){
            $where .= " AND `makes`.`id` = '{$_GET['radio_model']}' ";
        }else{
            // WHERE 
            $where = " WHERE `makes`.`id` = '{$_GET['radio_model']}' ";
        }
    }
    if(isset($_GET['range_min']) && isset($_GET['range_max'])){
        if(isset($where)){
            $where .= " AND `products`.`price` >= {$_GET['range_min']} AND `products`.`price` <= {$_GET['range_max']}";
        }
        else{
            $where = " WHERE `products`.`price` >= {$_GET['range_min']} AND `products`.`price` <= {$_GET['range_max']}";
        }
    }
    if(isset($where)){
        $result = $mysqli->query( 
        "SELECT `product_colors`.*, `product_memory`.*, `makes`.*, `products`.* FROM `products` 
            LEFT JOIN `product_colors` ON `product_colors`.`product_id` = `products`.`id` 
            LEFT JOIN `product_memory` ON `product_memory`.`product_id` = `products`.`id` 
            LEFT JOIN `makes` ON `products`.`model_id` = `makes`.`id` $where
            GROUP BY `products`.`id` 
            ");
    }else{
        $result = $mysqli->query( 
        "SELECT `product_colors`.*, `product_memory`.*, `makes`.*, `products`.* FROM `products` 
            LEFT JOIN `product_colors` ON `product_colors`.`product_id` = `products`.`id` 
            LEFT JOIN `product_memory` ON `product_memory`.`product_id` = `products`.`id` LEFT JOIN `makes` ON `products`.`model_id` = `makes`.`id` 
            GROUP BY `products`.`id`
            ");
    }
// }

if($result->num_rows == 0){
    $_SESSION['db_products']['error']="Товаров полный ноль";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="components/range/nouislider.min.css">
    <link rel="stylesheet" href="components/scroll/aos.css">
    <link rel="stylesheet" href="style.css">

    <!-- <link rel="stylesheet" href="range/style.css"> -->


    <title>Главная</title>
</head>

<body>
    <?php
    include('./header.php')
        ?>
    <div class="bottom__header">
        <div class="bottom__header__img">
            <div class="tel_one">
                <img src="assets/img/телефон.png" alt="">
            </div>

            <div class="tel_two">
                <img src="assets/img/tel_two.png" alt="">
            </div>
        </div>
        <div class="bottom__header__right">
            <div class="bottom__header__right__h">
                <p>Samsung Galaxy A53</p>
            </div>
            <div class="bottom__header__right__p">
                <p>Смартфон Samsung Galaxy A53 5G со встроенной памятью 256 ГБ просто обескураживает своей
                    возможностью хранить десятки приложений и тысячи фотографий.</p>
            </div>
            <div class="bottom__header__right_a_img">
                <div class="bottom__header__right__a">
                    <p> Другие предложения</p>
                    <div class="bottom__header__right__a__link">
                        <img src="assets/img/Ellipse 2.png" alt="" id="allipse">
                        <img src="assets/img/Arrow 1.png" alt="" id="arrow">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main">
        <div class="top">
            <div class="container">
                <div class="top__main" data-aos="fade-up">
                    <div class="top__main__left">
                        <div class="top__main__left__h">
                            <p>Samsung Galaxy S21</p>
                        </div>
                        <div class="top__main__left__ul">
                            <ul>
                                <li> Диагональ дисплея (дюйм): 6.2</li>
                                <li>Разрешение дисплея (пикс): 2400x1080</li>
                                <li>Встроенная память (Гб): 128</li>
                                <li>Основная камера (Мп): 64 + 12 + 12 (тройная)</li>
                                <li>Оптический зум: да</li>
                            </ul>
                        </div>
                    </div>
                    <div class="top__main__right">
                        <div class="top__main__right__img">
                            <img src="assets/img/main_tel_one.png" alt="" id="tel">
                        </div>
                        <div class="top__main__right__button">
                            <button id="main-more">Подробнее</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top two" data-aos="fade-up">
            <div class="container">
                <div class="top__main two">
                    <div class="top__main__left">
                        <div class="top__main__left__h">
                            <p id="S23">Samsung Galaxy S23</p>
                        </div>
                        <div class="top__main__left__ul two">
                            <ul>
                                <li>Диагональ дисплея (дюйм): 6.6</li>
                                <li>Разрешение дисплея (пикс): 2408x1080</li>
                                <li>Встроенная память (Гб): 64</li>
                                <li>Основная камера (Мп): 50 + 5 + 2 + 2 (четыре основные камеры)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="top__main__right">
                        <div class="top__main__right__img">
                            <img src="assets/img/main_tel_two.png" alt="" id="tel">
                        </div>
                        <div class="top__main__right__button">
                            <button id="main-more">Подробнее</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <main class="catalog" id="catalog" data-aos="fade-up">
        <div class="container">
            <div class="top__catalog" name="catalog" data-aos="fade-up">
                <div class="top__catalog__h1" id="top__catalog__h1">
                    <p>КАТАЛОГ</p>
                </div>
                <div class="top__catalog__searc">
                    <p>Сортировать</p>
                </div>
            </div>
            <div class="catalog__goods">
                <form class="catalog__goods__left" action="#top__catalog__h1" method="get">
                    <div class="catalog__googs__left__block">
                        <div class="goods_left_h">
                            <p>Фильтр</p>
                        </div>
                        <hr>
                        <div class="goods_left_model"></div>
                        <div class="googs_h">
                            <p>Модель</p>
                        </div>
                        <?php 
                            $models = mysqli_query($mysqli, "SELECT * FROM `makes`");
                            foreach($models as $keyModel => $valueModel):
                        ?>
                        <div class="googs_radio"> 
                            <input type="radio" id="radio_model" name="radio_model" value="<?= $valueModel['id']?>">
                            <label for="radio_model"><?= $valueModel['model']?></label>
                        </div>
                        <?php endforeach; ?>
                        <div class="button_larger">
                            <button id="button_larger">Показать больше</button>
                        </div>

                        <hr>
                        <div class="goods_left_color">
                            <div class="googs_h">
                                <p>Цвет</p>
                            </div>
                            <?php 
                                $colors = mysqli_query($mysqli, "SELECT * FROM `colors`");
                                foreach($colors as $keyColor => $valueColor):
                            ?>
                            <div class="googs_radio">
                                <input type="radio" id="radio_color" name="radio_color" value="<?=$valueColor['id']?>">
                                <label for="radio_color"><?=$valueColor['color']?></label>
                            </div>
                            <?php endforeach; ?>
                            <div class="button_larger">
                                <button id="button_larger">Показать больше</button>
                            </div>
                        </div>
                        <hr>
                        <div class="goods_left_color">
                            <div class="googs_h">
                                <p>Объём памяти</p>
                            </div>
                            <?php 
                                 $ROM = mysqli_query($mysqli, "SELECT * FROM `memory`");
                                 foreach($ROM as $keyROM => $valueROM):
                            ?>
                            <div class="googs_radio">
                                <input type="radio" id="radio_memory" name="radio_memory" value="<?= $valueROM['id']?>">
                                <label for="radio_memory"><?= $valueROM['ROM']?></label>
                            </div>
                            <?php endforeach; ?>
                            <div class="button_larger">
                                <button id="button_larger">Показать больше</button>
                            </div>
                        </div>
                        <hr>
                        <div class="googs_left_model_count" id="googs_left_model_count">
                            <div class="googs_h">
                                <p>Цена</p>
                            </div>
                            <div class="googs_range">
                                <div class="range_left">
                                    <input type="number" id="range_left" name="range_min" value="1" min="1" max="80000">
                                </div>
                                <div class="range_right">
                                    <input type="number" id="range_right" name="range_max" value="80000" min="1" max="80000">
                                </div>
                            </div>


                            <div class="slider-track" id="slider-track"></div>



                        </div>

                        <div class="button_goods_more">
                            <div id="button_goods_more">
                                <button class="more" id="more">Показать варианты</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="catalog__goods__right">

                <?php 
                if(isset($_SESSION['db_products']['error'])){?>
                   <div class="grid-catalog__h2">
                            <h3><?=$_SESSION['db_products']['error']."</p>";?></h3>
                    </div>
                <?php
            } foreach($result as $key => $product):?>
                     <!-- Здесь начинается каталог -->
                     <div class="grid-catalog" id = "product-<?= $product['id'];?>">
                        <div class="grid-catalog__img">
                            <img src="assets/img/<?= $product['img'];?>" alt="" id="grid-catalog">
                        </div>
                        <div class="grid-catalog-middle">
                            <div class="grid-catalog__h2">
                                <h3><?= $product['name'];?></h3>
                            </div>
                            <div class="grid-catalog__button-color">
                            <?php
                                    $colorsProduct = mysqli_query($mysqli, "SELECT `colors`.*, `product_colors`.* FROM `product_colors` LEFT JOIN `colors` ON `product_colors`.`color_id` = `colors`.`id` WHERE `product_colors`.`product_id` = '{$product['id']}'");
                                    foreach($colorsProduct as $keyColor => $valueColor):
                                ?>
                                <button id="color-black" style="background-color: <?= $valueColor['color']?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="grid-catalog-bottom">
                            <div class="grid-catalog__button-busket">
                                <button id="btn-basket">
                                    В корзину
                                </button>
                            </div>
                            <div class="grid-catalog__p-count">
                                <p><?= $product['price'];?></p>
                            </div>
                        </div>
                        <div class="grid-catalog__a-more">
                            <a href="product.php?id=<?= $product['id'] ?>" id="grid-catalog__a-more">Подробнее</a>
                        </div>
                    </div>
                    <!-- Здесь заканчивается главная часть каталога -->
                <?php endforeach;

                ?> 

                </div>
            </div>
        </div>
    </main>
    <?php
    include('./footer.php')
        ?>
    <script src="components/range/nouislider.min.js"></script>
    <script src="components/scroll/aos.js"></script>
    <!-- <script src="range/script.js"></script> -->
    <script src="script.js"></script>
</body>

</html>