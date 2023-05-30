<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$id=$_GET["id"];
	$connect->query("DELETE FROM `products` WHERE `product_id`='$id'");
	$connect->query("DELETE FROM `orders` WHERE `product_id`='$id'");
	return header("Location:../admin.php?message=Товар удалён");