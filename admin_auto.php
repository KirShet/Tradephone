<?php
    session_start();
    include './core.php';

    if(isset($_SESSION['admin'])){
        if ($_SESSION['admin'] == true) {
            header('Location: index.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_admin.css">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация</title>
</head>

<body>
    <?php
    include('./header.php')
    ?>
    <main>
        <form action="login.php" method="post">
            <div class="auto">
                <div class="auto-block">
                    <div class="auto-block__h">
                        <h3>Авторизация админа</h3>
                        <span style="color:red"><?php if(isset($_SESSION['loginError'])) echo $_SESSION['loginError']; unset($_SESSION['loginError']) ?></span>
                    </div>
                    <div class="auto-block__input-login">
                        <input type="text" id="login" name="login" placeholder="Логин">
                    </div>
                    <div class="auto-block__input-password">
                        <input type="text" id="password" name="password" placeholder="Пароль">
                    </div>
                    <div class="auto-block__button-enter">
                        <button id="autoEnter" type="submit" name="submitLogin">Войти</button>
                    </div>
                    <div class="auto-block__button-cancel">
                        <button id="autoCancel" type="submit">Отмена</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>

</html>