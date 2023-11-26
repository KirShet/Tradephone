<?php
include './core.php';

if (isset($_POST["submitLogin"])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
    $result = mysqli_query($mysqli, $sql);
    
    if ($result->num_rows == 0) {
        $_SESSION['loginError'] = 'Неверный логин или пароль.';
        header('location: ./admin_auto.php');
    } else {
        $_SESSION['admin'] = true;
        header('location: ./index.php');
    }
}


?>