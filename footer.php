<footer class="footer" id="contact" data-aos="fade-up">
    <div class="container">
        <div class="footer-block">
            <div class="footer-block-left">
                <div class="footer-block-left__p">
                    <p>КОНТАКТЫ</p>
                </div>
                <div class="fotter-block-left__contact">
                    <img src="assets/img/footer-contact.png" alt="" id="footer-contact">
                    <p>г. Омск, ул. Красный путь</p>
                </div>
                <div class="footer-block-left__number">
                    <img src="assets/img/footer-number.png" alt="" id="footer-number">
                    <p>8 951 789 78 90</p>
                </div>
                <div class="footer-block-left-email__p">
                    <p>Подписаться на уведомления</p>
                </div>
                <form action="subscribe.php" method="post">
                    <div class="footer-block-left-email">
                        <div class="footer-block-left-email__input">
                            <fieldset>
                                <legend id="legend">E-mail</legend>
                                <input type="email" id="footer-email__input" name="email">
                            </fieldset>
                        </div>

                        <div class="footer-block-left-email__button">
                            <button type="submit" name="footer-email__button" id="footer-email__button">
                                Подписаться
                            </button>
                        </div>
                    </div>

                    <p style="color: red; margin: 10px 0 0 0">
                        <?php
                        if(isset($_SESSION['err'])) {
                            echo $_SESSION['err'];
                            unset($_SESSION['err']);
                        }
                        ?>
                    <p>
                </form>
                <div class="footer-block-conf__p">
                    <p>Политика конфиденциальности</p>
                </div>
            </div>
            <div class="footer-block-right">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3849.3018335429974!2d73.37184758099278!3d54.993990346901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43aafe17f49a98c1%3A0xbd7031ddd6849111!2z0KTQu9Cw0LPQvNCw0L0!5e0!3m2!1sru!2sru!4v1679119707236!5m2!1sru!2sru"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <div class="footer-header">
            <div class="top__header">
                <div class="top__header__left">
                    <div class="logo">
                        <img src="assets/img/logo-footer.png" alt="">
                    </div>
                </div>
                <div class="top__header__center">
                    <div class="link-footer">
                        <a href="./index.php">Главная</a>
                        <a href="./discounts.php">Акции</a>
                        <a href="./catalog.php">Каталог</a>
                        <a href="./contacts.php">Контакты</a>
                    </div>
                </div>
                <!-- авторизация -->
                <div class="top__header__right">
                    <div class="auto">
                        <a href="./login.php"><img src="assets/img/footer-vk.png" alt="" id="footer-vk"></a>
                    </div>
                    <div class="busket">
                        <a href="./product/busket.php"><img src="assets/img/footer-youtube.png" alt="" width="40px"
                                height="40px"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>