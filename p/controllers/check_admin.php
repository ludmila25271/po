<?php
	include "check.php";//Проверяем авторизацию пользователя
	if($_SESSION["role"] != "admin")//Если параметр 'role' не равен значению 'admin'
		return header("Location:../corz.php?message=Отказано в доступе");//Выводим сообщение "Отказано в доступе"