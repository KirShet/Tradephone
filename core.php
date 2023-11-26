<?php
$mysqli = new mysqli('localhost', 'root', '', 'tradephone');
if($mysqli->error) die("Ошибка подключения к базе данных: " . $conn->connect_error);

session_start();
?>