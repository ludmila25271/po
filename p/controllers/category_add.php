<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$new_cat=$_POST["category"];
	$connect->query("INSERT INTO `categories`(`category`) VALUES('$new_cat')");
	return header("Location:../admin.php");

