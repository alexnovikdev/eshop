<?php
require "inc/lib.inc.php";
require "inc/config.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strtolower(strip_tags(trim($_POST["name"])));
    $email = strtolower(strip_tags(trim($_POST["email"])));
    $phone = strtolower(strip_tags(trim($_POST["phone"])));
    $address = strtolower(strip_tags(trim($_POST["address"])));

    $id = $basket["orderid"];
    $dt = time();

    $order = $name . "|" . $email . "|" . $phone . "|" . $address . "|" . $id . "\n";
    file_put_contents("admin/" . ORDERS_LOG, $order, FILE_APPEND);

    saveOrder($dt);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Сохранение данных заказа</title>
</head>
<body>
	<p>Ваш заказ принят.</p>
	<p><a href="catalog.php">Вернуться в каталог товаров</a></p>
</body>
</html>