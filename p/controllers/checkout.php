<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$sql = sprintf("SELECT * FROM `root` WHERE `user_id`='%s'", $_SESSION["user_id"]);//Подтверждаем аккаунт паролем
	//$password = md5($password."ghjsfkld2345");
	if($connect->query($sql)->fetch_assoc()["password"] != $_POST["password"])
		return header("Location:../corz.php?message=Ошибка пароля");//Если пользователь не найден, то выводим сообщение

	$sql = sprintf("SELECT SUM(`count`) FROM `orders` WHERE `user_id`='%s' AND `number` IS NULL", $_SESSION["user_id"]);//Создаем список строк заказа, принадлежащего этому пользователю
	$count = $connect->query($sql)->fetch_array()[0];//Записываем их в массив

	$connect->query(sprintf("INSERT INTO `orders`(`product_id`, `user_id`, `number`, `count`, `status`) VALUES('0', '%s', '%s', '%s', 'Новый')", $_SESSION["user_id"], rand(1000000000, 2000000000), $count));//Строчка добавления товара в заказ

	$connect->query(sprintf("DELETE FROM `orders` WHERE `user_id`='%s' AND `number` IS NULL", $_SESSION["user_id"]));//Строчка удаления товара из заказа

	return header("Location:../corz.php?message=Заказ оформлен");//Переходим на страницу корзины с сообщением "Заказ оформлен"