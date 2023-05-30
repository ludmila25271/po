<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$id = $_GET["id"];//Получаем id товара

	//Объединяем данные из таблиц заказа и товара, где id товара равен переданному значению 
	$sql = sprintf("SELECT `order_id`, `product_id`, `number`, `orders`.`count` as `ocount`, `name`, `products`.`count` as `pcount` FROM `orders` INNER JOIN `products` USING(`product_id`) WHERE `user_id`='%s' AND `product_id`='%s'", $_SESSION["user_id"], $id);
	$order = $connect->query($sql)->fetch_assoc();//Получаем массив строк

	if($order["ocount"] > 1)//Если количество товара в корзине больше 1, то уменьшаем количество товара на 1
		$connect->query(sprintf("UPDATE `orders` SET `count`='%s' WHERE `order_id`='%s'", --$order["ocount"], $order["order_id"]));
	//Иначе просто удаляем строку из таблицы заказа
	else
		$connect->query(sprintf("DELETE FROM `orders` WHERE `user_id`='%s' AND `product_id`='%s'", $_SESSION["user_id"], $order["product_id"]));
	//Обновляем таблицу с товарами, увеличивая количество товара на 1
	$connect->query(sprintf("UPDATE `products` SET `count`='%s' WHERE `product_id`='%s'", ++$order["pcount"], $order["product_id"]));

	//Переходим на страницу корзины с сообщением "Товар удален из корзины"
	return header("Location:../corz.php?message=Товар удалён из корзины");
