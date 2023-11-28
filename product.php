<?php session_start();
include './core.php';
if ($_GET['id']) {
    $products = $mysqli->query("SELECT * FROM products WHERE id = '{$_GET['id']}'");
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
        
    // $find_return = $products->fetch_assoc() ? true : false;
    if ($products->num_rows == 0) {
        $_SESSION['errors_updateTovar'] = 'Товара под таким id не найдено!';
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    $product = $products->fetch_assoc();
    $productReviews = mysqli_query($mysqli, "SELECT * FROM `reviews` WHERE product_id = '{$_GET['id']}'");

    $productsHits =  mysqli_query($mysqli, "SELECT `products`.*, `product_colors`.*, `product_memory`.*, `makes`.* FROM `products`
    LEFT JOIN `product_colors` ON `product_colors`.`product_id` = `products`.`id` 
    LEFT JOIN `product_memory` ON `product_memory`.`product_id` = `products`.`id` 
    LEFT JOIN `makes` ON `products`.`model_id` = `makes`.`id`
    GROUP BY `products`.`id` ORDER BY `products`.`point`/ `products`.`count_reviews` DESC LIMIT 5
");
}else if(isset($_SERVER['HTTP_REFERER'])){
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./components/swiper/swiper.min.css">
    <link rel="stylesheet" href="./components/slider/css/slick.css">

    <link rel="stylesheet" href="./components/slider/css/styl.css">
    <link rel="stylesheet" href="./components/scroll/aos.css">
    <link rel="stylesheet" href="./product/style.css">
    <title><?= $product['name'] ?></title>
</head>

<body>
    <?php
    include('./header.php')
        ?>
    <!-- модальное окно -->
    <div class="main-modal">
        <div class="main-modal-container">
            <div class="main-modal__h-input-block">
                <div class="main-modal-exit__input">
                    <input type="button" id="modal-exit" value="Закрыть" onclick="exit()">
                </div>
                <div class="main-modal__h">
                    <h3>Напишите свой отзыв</h3>
                </div>
            </div>

            <form action="/product/review-add.php" method="post">
                <!-- ,kjr -->
                <div class="main-admin-update-inputs">
                    <select name="product_point" id="">
                        <option value="1">Звёзд: 1</option>
                        <option value="2">Звёзд: 2</option>
                        <option value="3">Звёзд: 3</option>
                        <option value="4">Звёзд: 4</option>
                        <option value="5">Звёзд: 5</option>
                    </select>
                </div>
                <!-- ,kjr -->
                <input type="hidden" name="product_id" value="<?=$product['id']?>">
                <!-- jjh -->
                <div class="main-modal-name">
                    <input type="text" id="modal-name" 
                    name="modal-name" 
                    placeholder="Имя">
                </div>
                <div class="main-modal-text">
                    <textarea name="modal-text" id="modal-text" placeholder="текст отзыва"></textarea>
                </div>
                <div class="main-modal__button">
                    <button id="modal-add" name="modal-add">Добавить отзыв</button>
                </div>
            </form>
                <?php
                    if(isset($_SESSION['errors_modal-add'])){
                        foreach ($_SESSION['errors_modal-add'] as $key => $value){
                            if($value!="modal-add"){
                                echo "<p style='color:red; font-size: 20px'>$value</p>";
                            }
                        }
                    }
                    // unset($_SESSION['errors_modal-add']);
                    // var_dump($_SESSION['errors_modal-add']);
                ?>
        </div>
    </div>
    <!-- конец модального окна -->
    <main class="main">
        <div class="container">
            <div class="main-top">
                <div class="main-top__p">
                    <p><?= $product['name'] ?></p>
                </div>
                <div class="main-top-status">
                <?php 
                    if(!$product['count_reviews'] == 0){
                ?>
                    <?$star = $product['point']/$product['count_reviews']?>
                    <?=$star?>
                                <?php
                                $i=0;
                                    while ($i < $star):
                                        $i++;
                                        // echo $i;
                                        ?>
                                        <img src="./assets/img/true-status.png" alt="" id="status1">
                                        <?php
                                    endwhile;?>
                                     <?php
                                    while ($star < 4.5):
                                        $star++;
                                        // echo $star;
                                        ?>
                                        <img src="./assets/img/false-status.png" alt="" id="status5">
                                        <?php
                                    endwhile;?>
                                    <?php } ?>
                </div>
            </div>
            <div class="main-top-review">
                <div class="main-top-review__p">
                    <p><?= $product['count_reviews']?> отзыв(а/ов)</p>
                </div>
            </div>
            <div class="main-middle">
                <div class="main-middle-left">
                    <div class="cliders">
                        <div class="clider-block">
                            <div class="slider-wrapper"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                        <div class="clider-block">
                            <div class="slider-wrapper"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                        <div class="clider-block">
                            <div class="slider-wrapper"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                        <div class="clider-block">
                            <div class="slider-wrapper"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                    </div>
                    <div class="cliders-two">
                        <div class="clider-block">
                            <div class="slider-wrapper-two"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                        <div class="clider-block">
                            <div class="slider-wrapper-two"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                        <div class="clider-block">
                            <div class="slider-wrapper-two"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                        <div class="clider-block">
                            <div class="slider-wrapper-two"><img src="./assets/img/slider-one.png" alt=""></div>
                        </div>
                    </div>
                </div>

                <div class="main-middle-right">
                    <div class="main-middle-right__h">
                        <h1><?= $product['name'] ?></h1>
                    </div>
                    <div class="main-middle-right-color__button">
                    <?php foreach($colr_prod as $row_color):?>
                        <button id="color1" style="width: 25px; height: 25px; border: 1px solid rgba(0, 0, 0, 0.25); border-radius: 50%; background-color: <?php echo $row_color['color']; ?>;">
                        </button>
                        <?php endforeach;?>
                    </div>
                    <div class="main-middle-right-ROM__p">
                        <p>Встроенная память (ROM)</p>
                    </div>
                    <form action="">
                        <div class="main-middle_right-ROM__radio">
                        <?php foreach($memr_prod as $row_memory):?>
                            <input type="radio" id="ROM1" name="ROM" value="1">
                            <label for="ROM1"><?php echo $row_memory['ROM']; ?>GB</label>
                        <?php endforeach;?>
                        </div>
                    </form>
                    <div class="main-middle-right__p">
                        <p>О товаре</p>
                    </div>
                    <div class="main-middle-right__description__p">
                        <p><?= $product['description'] ?></p>
                    </div>
                    <div class="main-middle-right-button_count">
                        <div class="main-middle-right__button">
                            <button id="main-middle-right">
                                В корзину
                            </button>
                            <button id="main-middle-right-reviews" onclick="add()">
                                Добавить отзыв
                            </button>
                        </div>
                        <div class="main-middle-right-count__p">
                            <p><?= $product['price'] ?>$</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="main-characteristic">
                <h1>ХАРАКТЕРИСТИКИ</h1>
                <div class="main-characteristic-block">
                    <div class="main-characteristic-left">
                        <div class="charact__h">
                            <h3>Заводские данные</h3>
                        </div>
                        <div class="charact__p">
                            <p>Гарантия от продавца</p>
                            <p><?= $product['guarantee'] ?> мес.</p>
                        </div>
                        <hr>
                        <div class="charact__h">
                            <h3>Общие параметры</h3>
                        </div>
                        <div class="charact__p">
                            <p>Модель</p>
                            <p><?= $product['model'] ?></p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Год релиза</p>
                            <p><?= $product['release_year'] ?></p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Диагональ экрана (дюйм)</p>
                            <p><?= $product['diagonal'] ?> "</p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Разрешение экрана</p>
                            <p><?= $product['resolution'] ?></p>
                        </div>
                        <hr>
                    </div>
                    <div class="main-characteristic-right">
                        <div class="charact__h">
                            <h3>Общие параметры</h3>
                        </div>
                        <div class="charact__p">
                            <p>Модель</p>
                            <p><?= $product['model'] ?></p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Год релиза</p>
                            <p><?= $product['release_year'] ?></p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Диагональ экрана (дюйм)</p>
                            <p><?= $product['diagonal'] ?> "</p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Разрешение экрана</p>
                            <p><?= $product['resolution'] ?></p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Разрешение экрана</p>
                            <p><?= $product['resolution'] ?></p>
                        </div>
                        <hr>
                        <div class="charact__p">
                            <p>Разрешение экрана</p>
                            <p><?= $product['resolution'] ?></p>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
            <?php 
                if($productReviews -> num_rows > 0){
            ?>
            <div class="main-reviews">
                <div class="main-reviesw__h">
                    <h1>ОТЗЫВЫ</h1>
                </div>
                <div class="swiper-container main-reviesw-block">
                    <div class="swiper-wrapper">
                        <?php 
                            foreach($productReviews as $key => $review):
                        ?>
                        <div class="main-reviews-item swiper-slide card">
                            <div class="main-reviews-item__h-status">
                                <div class="main-reviews-item__h">
                                    <h3><?= $review['name']?></h3>
                                </div>
                                <div class="main-reviews-item-status">
                                <p style="font-size: 18px;">Оценка: <span style="color: #C14231;"><?= $review['point']?></span></p>
                                <?php
                                $i=0;
                                    while ($i < $review['point']):
                                        $i++;
                                        ?>
                                        <img src="./assets/img/true-status.png" alt="" id="status1">
                                        <?php
                                    endwhile;?>
                                     <?php
                                    while ($review['point'] < 5):
                                        $review['point']++;
                                        ?>
                                        <img src="./assets/img/false-status.png" alt="" id="status5">
                                        <?php
                                    endwhile;?>
                                    <!-- <img src="./assets/img/true-status.png" alt="" id="status1">
                                    <img src="./assets/img/true-status.png" alt="" id="status2">
                                    <img src="./assets/img/true-status.png" alt="" id="status3">
                                    <img src="./assets/img/false-status.png" alt="" id="status4">
                                    <img src="./assets/img/false-status.png" alt="" id="status5"> -->
                                </div>
                            </div>
                            <div class="main-reviesw__p">
                                <p><?= $review['description']?></p>
                            </div>
                            <div class="main-reviesw-date">
                                <p>29.12.2022</p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="main-reviesw-block__button">
                    <button class="swiper-button-do"></button>
                    <button class="swiper-button-let"></button>
                </div>
            </div>
            <?php }?>
            <div class="main-hits">
                <div class="main-hits__h">
                    <h1>ХИТЫ ПРОДАЖ</h1>
                </div>
                <div class="main-hits-block">
                <?php 
                        foreach($productsHits as $key => $value):
                    ?>
                    <div class="grid-catalog">
                        <div class="grid-catalog__img">
                            <img src="./assets/img/grid-catalog.png" alt="" id="grid-catalog">
                        </div>
                        <div class="grid-catalog-middle">
                            <div class="grid-catalog__h2">
                                <h3>Apple IPhone 11</h3>
                            </div>
                            <div class="grid-catalog__button-color">
                                <button id="color-black"></button>
                                <button id="color-two"></button>
                                <button id="color-three"></button>
                            </div>
                        </div>
                        <div class="grid-catalog-bottom">
                            <div class="grid-catalog__button-busket">
                                <button id="btn-basket">
                                    В корзину
                                </button>
                            </div>
                            <div class="grid-catalog__p-count">
                                <p>160$</p>
                            </div>
                        </div>
                        <div class="grid-catalog__a-more">
                            <a href="" id="grid-catalog__a-more">Подробнее</a>
                        </div>
                    </div>
                    <?php 
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </main>
    <?php
    include('./footer.php')
        ?>
    <script src="./components/swiper/swiper.min.js"></script>
    <script src="./components/slider/js/jquery.js"></script>
    <script src="./components/slider/js/slick.js"></script>
    <script src="./components/scroll/aos.js"></script>
    <script src="./components/modal/modal.js"></script>
    <script src="./components/slider/js/script.js"></script>
    <script src="./script.js"></script>

</body>

</html>