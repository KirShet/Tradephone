<?php
session_start();
include './core.php';
if (isset($_POST["footer-email__button"])) {
    if ($_POST["email"] == "") {
        $_SESSION['err'] = "Поле не должно быть пустым.";
    }
    else {
        $sendEmail = $_POST["email"];
        mysqli_query($mysqli, "INSERT INTO `subscriptions`(`email`) VALUES ('$sendEmail')");
    }
}

header('Location: ./index.php')
?>