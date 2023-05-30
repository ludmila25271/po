<?php
session_start();//Проверяем авторизацию пользователя
$connect = mysqli_connect('localhost', 'root', '', 'users');

	$connect->query("UPDATE `orders` SET `status`='Подтверждённый' WHERE `order_id`=".$_POST["id"]);
	return header("Location:../admin.php?message=Статус заказа изменёна на \"Подтверждённый\"");
