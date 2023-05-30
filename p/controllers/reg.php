<!-- Код, выполняемый при регистрации нового пользователя -->
<?php
// Проверяем формат данных, введенных в формы пользователем
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
$patronymic = filter_var(trim($_POST['patronymic']), FILTER_SANITIZE_STRING);
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
$password1 = filter_var(trim($_POST['password-repeat']), FILTER_SANITIZE_STRING);

//Если длина логина меньше 2 или больше 90 символов, то 
if(mb_strlen($login) < 2 || mb_strlen($login) > 90) {
    echo "Недопустимая длина логина"; //Выводим сообщение "Недопустимая длина логина"
    exit(); //Прекращаем выполнение текущего скрипта
}
//Если длина имени меньше 2 или больше 50 символов, то 
else if(mb_strlen($name) < 2 || mb_strlen($name) > 50) {
    echo "Недопустимая длина имени"; //Выводим сообщение "Недопустимая длина имени"
    exit(); //Прекращаем выполнение текущего скрипта
}
//Если длина пароля меньше 5 или больше 30 символов, то 
else if(mb_strlen($password) < 5 || mb_strlen($password) > 30) {
    echo "Недопустимая длина пароля"; //Выводим сообщение "Недопустимая длина пароля"
    exit(); //Прекращаем выполнение текущего скрипта
}
//Шифруем введенный пароль в формате 128-bit hash для записи в базу данных
//$password = md5($password."ghjsfkld2345");

//Подключение к БД
$mysql = new mysqli('localhost', 'root', '', 'users'); //В скобках указываются имя хоста, пользователь, пароль к БД и сама БД
//Записываем информацию с форм в ячейки таблицы root (имя и названия столбцов таблицы изменить под свои значения)
$mysql->query("INSERT INTO `root` (`name`, `surname`, `patronymic`, `login`, `email`, `password`, `role`) 
VALUES('$name', '$surname', '$patronymic', '$login', '$email', '$password', 'client')");
$mysql->close(); //Разрываем соединение с базой данных

header('Location: ../log_in.php'); //По выполнении скрипта переходим на страницу авторизации (можно указать любую другую)
?>
