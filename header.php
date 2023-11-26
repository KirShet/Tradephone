<header class="header" data-aos="fade-up">
    <div class="container">
        <!-- Верхняя часть хедера -->
        <div class="top__header">
            <div class="top__header__left">
                <div class="logo">
                    <img src="assets/img/Rectangle64.png" alt="">
                </div>
            </div>
            <div class="top__header__center">
                <div class="link">
                    <a href="./index.php">Главная</a>
                    <a href="./discounts.php">Акции</a>
                    <a href="./index.php#catalog">Каталог</a>
                    <a href="./modal.php">Контакты</a>
                    <?php if(($_SESSION['admin'] ?? '') != ''){
                        // if (($_SESSION['login'] ?? '') === '');
                        echo '<a href="./admin_panel.php">Админ-панель</a>';
                    } ?>
                </div>
            </div>
            <!-- авторизация -->
            <div class="top__header__right">
                <div class="auto">
                    <?php
                    if (($_SESSION['admin'] ?? '') == '') {
                        echo '<a href="./admin_auto.php">Вход</a>';
                    } else {
                        echo '<a href="./logout.php">Выход</a>';
                    } 
                    ?>
                </div>
                <div class="busket">
                    <?php
                    if (($_SESSION['admin'] ?? '') == '') {
                        echo '<a href="./busket.php"><img src="./assets/img/busket.png" alt="" width="40px" height="40px"></a>';
                    } else {
                        echo '<a href="./admin_basket.php"><img src="./assets/img/busket.png" alt="" width="40px" height="40px"></a>';
                    }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>

</header>