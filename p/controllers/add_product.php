<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$promo = "upload/1_". time() ."_". $_FILES["image1"]["name"];
	move_uploaded_file($_FILES["image1"]["tmp_name"], "../".$promo);
	$picture = "upload/1_". time() ."_". $_FILES["image2"]["name"];
	move_uploaded_file($_FILES["image2"]["tmp_name"], "../".$picture);
    $category=$_POST['category'];
	$connect->query(sprintf("INSERT INTO `products`(`name`, `price`, `country`, `year`, `model`, `category`, `count`, `promo`, `picture`) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $_POST["name"], $_POST["price"], $_POST["country"], $_POST["year"], $_POST["model"], $category, $_POST["count"], $promo, $picture));

	return header("Location:../admin.php?message=Товар добавлен");