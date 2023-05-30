<?php
	session_start();//Проверяем авторизацию пользователя
    $connect = mysqli_connect('localhost', 'root', '', 'users');
	$category=$_POST['category'];
	$connect->query("DELETE FROM `categories` WHERE `category`='$category'");
	return header("Location:../admin.php");
