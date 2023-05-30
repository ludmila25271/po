<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MersBen</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@100;200;300;400;500&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<header class="header">
        <div class="container">
            <div class="head_inner">
            <a href="index.php"><h1 class="header_logo">MersBen</h1></a>
             <nav class="nav">
                <a class="nav_link" href="index.php">О нас</a>
                <a class="nav_link" href="catalogue.php">Каталог</a>
                <a class="nav_link" href="contacts.php">Где нас найти?</a>
                <a class="nav_link" href="log_in.php">Вход</a>
             
             <?php
             session_start();
             if (isset($_SESSION['role']) and $_SESSION["role"]=="admin"){
               echo
               '<a class="nav_link" href="admin.php">Админ</a>';
            }
            ?>
            </nav>
            <?php
            if (isset($_COOKIE['root'])) {
                echo '
             <div class="icons">
             <a href="corz.php" class="icon"><i class="fa-solid fa-basket-shopping"></i></a>
             <a href="controllers/exit.php" class="icon"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></div>';
            }
            ?>
            </div>
        </div>
    </header>
    <?php
        session_start();
        $connect = mysqli_connect('localhost', 'root', '', 'users');
        $sql = sprintf("SELECT `order_id`, `product_id`, `orders`.`count`, `name`, `price`, `promo` FROM `orders` INNER JOIN `products` USING(`product_id`) WHERE `user_id`='%s'", $_SESSION["user_id"]);
	$result = $connect->query($sql);//Получаем массив строк

	$products = "";//Задаем пустое значение переменной 'products'
	while($row = $result->fetch_assoc())//Добавляем в массив строки из таблицы, которые потом выведем на экран
		$products .= sprintf('
        <div class="shop_box" id="prod_corz"> <!--Товар-->
        <h3 class="prod_name">%s</h3>
        <img src="%s" height="190px" width="300px" alt="Mercedes-Benz" title="Mercedes-Benz">
        <div class="info">
         <p class="price">%s</p>
         <a class="more" href="controllers/delete_cart.php?id=%s">Удалить</a>
        </div>
        </div>
		', $row["name"], $row["promo"], $row["price"], $row["product_id"]);

	if($products == "")//Если значение переменной равно 0
		$products = '<h3 class="corz_text">Корзина пуста</h3>';//Выводим сообщение "Корзина пуста"

	$sql = sprintf("SELECT * FROM `orders` WHERE `user_id`='%s' AND `number` IS NOT NULL AND `product_id`=0 ORDER BY `created_at` DESC", $_SESSION["user_id"]);//Иначе выводим список товаров, добавленных в корзину
	$result = $connect->query($sql);//Приравниваем полученные данные одной переменной

	$orders = "";////Задаем пустое значение переменной 'orders'
	while($row = $result->fetch_assoc()) {
		$del = ($row["status"] == "Новый") ? 
        '<a onclick="return confirm(\'Вы действительно хотите удалить этот заказ?\')" href="controllers/delete_order.php?id='.$row["order_id"].'" class="delete">Удалить заказ</a>' : '';
		$orders .= sprintf('
			<div class="col">
				<div class="row">
					<h3>Заказ %s</h3>
					%s
				</div>
				<div class="row">
					<p>Статус: <b>%s</b></p>
					<p>Количество товаров: <b>%s</b></p>
				</div>
			</div>
		', $row["number"], $del, $row["status"], $row["count"]);
	}//Добавляем в массив строки из таблицы, которые потом выведем на экран

	if($orders == "")////Если значение переменной равно 0
		$orders = '<h3 class=corz_text id="cor">Список заказов пуст</h3>';////Выводим сообщение "Список заказов пуст"

    ?>
    <div class="intro" id="shopping">
        <div class="container">
          <h1 class="title_section"> Ваша корзина </h1>
          <div id="corz">
            <div class="string_align">
                <?= $products ?>
            </div>
            <form class="form" action="controllers/checkout.php" method="POST">
              <input class="polepas" type="password" placeholder="Пароль" name="password" required>
              <button class="order">Сформировать заказ</button>
            </form>
            </div>
            <h1 class="title_section" id="order"> Ваши заказы </h1>
            <div class="string_align">
             <?= $orders ?><!--Вывод списка оформленных заказов на экран-->
            </div>
        </div>
    </div>
    <footer class="footer" id="re_footer">
        <div class="container_foot">
             <p class="footer_text">© 2022 АО "MersBen"</p>
             <p class="footer_text" id="conf">Политика конфиденциальности</p>
        </div>
    </footer>
</body>
</html>