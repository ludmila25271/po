<!-- Код, выполняемый при выходе из личного кабинета -->
<?php 
session_start();//Запускаем сессию
setcookie('root', $root['user_id'], time() + 3600, "/");
unset($_SESSION["user_id"]);
unset($_SESSION["role"]);
header('Location: ../index.php'); //По выполнении скрипта переходим на страницу авторизации (можно указать любую другую)
?>