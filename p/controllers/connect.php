<?php
$connect = new mysqli_connect('localhost', 'root', '', 'users');
$connect->set_charset("utf8");
if($connect->connect_error)//Если возникла ошибка при подключении
die("Ошибка подключения: ". $connect->connect_error);
?>