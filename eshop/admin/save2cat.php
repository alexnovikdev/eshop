<?php
	// подключение библиотек
	require "secure/session.inc.php";
	require "../inc/lib.inc.php";
    require "../inc/config.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = strtolower(strip_tags(trim($_POST["title"])));
    $author = strtolower(strip_tags(trim($_POST["author"])));
    $pubyear = (int) $_POST["pubyear"];
    $price = (int) $_POST["price"];

    if(!addItemToCatalog($title, $author, $pubyear, $price, $link)) {
        echo "Произошла ошибка при добавлении товара в каталог";
    } else {
        header("Location: add2cat.php");
        exit;
    }
}