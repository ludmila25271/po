<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$id = $_GET["id"];//Получаем id товара
	$sql = "SELECT * FROM `products` WHERE `product_id`=".$id;//Выбираем все строки, где id товара равен переданному значению
	$product = $connect->query($sql)->fetch_assoc();//Получаем массив из строк таблицы
	if($product["count"] <= 0)//Если количество товара равно 0
		return header("Location:../corz.php?message=Товар отсутствует");//То выводим сообщение "Товар отсутствует"

	$sql = sprintf("SELECT * FROM `orders` WHERE `user_id`='%s' AND `product_id`='%s'",$_SESSION["user_id"], $id);//Получаем все записи, где id пользователя равно значению выполняемой сессии и id продукта равно переданному значению id
	if($order = $connect->query($sql)->fetch_assoc())//Получаем массив строк
		{
            $connect->query(sprintf("UPDATE `orders` SET `count`='%s' WHERE `order_id`='%s'", ++$order["count"], $order["order_id"]));//Увеличиваем количество товара в заказе на 1
        }
	//Если такая строка не найдена, создаем новую запись в таблице
	else
	{
        $connect->query(sprintf("INSERT INTO `orders`(`product_id`, `user_id`, `count`) VALUES('%s', '%s', '%s')", $product["product_id"], $_SESSION["user_id"], 1));
    }
	//Обновляаем количество товара в таблице "продукты" - уменьшаем его на 1
	$connect->query(sprintf("UPDATE `products` SET `count`='%s' WHERE `product_id`='%s'", --$product["count"], $product["product_id"]));
	//Переходим в корзину с сообщением "Товар добавлен в корзину"
	return header("Location:../corz.php?message=Товар добавлен в корзину");