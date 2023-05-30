<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	if($_FILES["image1"]["error"])
		$promo = $_POST["promo"];
	elseif($_FILES["image2"]["error"])
		$picture = $_POST["picture"];
	else {
		$promo = "images/upload/1_". time() ."_". $_FILES["image2"]["name"];
		move_uploaded_file($_FILES["image2"]["tmp_name"], "../".$picture);
	}

	$connect->query(sprintf("UPDATE `products` SET `name`='%s', `price`='%s', `country`='%s', `year`='%s', `model`='%s', `category`='%s', `count`='%s', `promo`='%s', `picture`='%s' WHERE `id`='%s'", $_POST["name"], $_POST["price"], $_POST["country"], $_POST["year"], $_POST["model"], $_POST["category"], $_POST["count"], $promo, $picture, $_POST["id"]));

	return header("Location:../product.php?id=".$_POST["id"]."&message=Товар изменён");
