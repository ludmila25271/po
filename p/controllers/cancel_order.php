<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$connect->query(sprintf("UPDATE `orders` SET `status`='Отменённый',`reason`='%s' WHERE `order_id`='%s'", $_POST["reason"], $_POST["id"]));
	return header("Location:../admin.php?message=Статус заказа изменёна на \"Отменённый\"");
