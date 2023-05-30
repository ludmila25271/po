<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MersBen</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script src="scripts/filter.js"></script>
    <script>
		let role = "<?= (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest" ?>";
	</script>
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
                <a class="active_link">О нас</a>
                <a class="nav_link" href="catalogue.php">Каталог</a>
                <a class="nav_link" href="contacts.php">Где нас найти?</a>
                <a class="nav_link" href="log_in.php">Вход</a>
             
             <?php
             session_start();
             if ($_SESSION["role"]=="admin"){
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
        $connect = mysqli_connect('localhost', 'root', '', 'users');
		$sql = "SELECT * FROM `categories`";//Получаем содержимое таблицы "категории"
		$result = $connect->query($sql);//Записываем их в массив
		$categories = "";//Присваиваем пустое значение переменной 'categories'
		while($row = $result->fetch_assoc())//Начинаем запись данных таблицы в переменную 'categories'
		{
            $categories .= sprintf('<option value="%s">%s</option>', $row["category"], $row["category"]);
        }
        $sql = "SELECT * FROM `orders` INNER JOIN `root` USING(`user_id`) ORDER BY `created_at` DESC";
	    $result = $connect->query($sql);
	    $orders = "";
	    while($row = $result->fetch_assoc()) {
		$adv = ($row["status"] == "Новый") ? '
			<form action="controllers/confirm_order.php" class="w100" method="POST">
				<input type="hidden" value="'.$row["order_id"].'" name="id" />
				<button class="btn">Подтвердить заказ</button>
			</form>
			<h3 class="text-center">Отменить заказ</h3>
			<form action="controllers/cancel_order.php" class="w100" method="POST">
				<input type="hidden" value="'.$row["order_id"].'" name="id" />
				<div class="row_align">
				<textarea class="text_area" placeholder="Причина отмены" name="reason" required></textarea>
				<button class="btn">Отменить заказ</button>
				</div>
			</form>
		' : '';
		$adv = ($row["status"] == "Отменённый") ? '
			<h3 class="text-center">Причина отмены:</h3>
			<p class="reason">'.$row["reason"].'</p>
		' : $adv;
		$orders .= sprintf('
			<div class="col">
			<h2>Заказ %s</h2>	
			<p style="margin-top:5px; font-size:23px;">Заказчик: <b>%s %s %s</b></p>
				<p>Статус заказа: <b>%s</b></p>
				<p>Количество товаров: <b>%s</b></p>
				<input type="hidden" value="%s" name="order_id" />
				%s
				<p class="time">%s</p>
			</div>
		', $row["number"], $row["name"], $row["surname"], $row["patronymic"], $row["status"], $row["count"], $row["order_id"], $adv, $row["created_at"]);
	}
	if(!$orders)
		$orders = '<h3>Заказы отсутствуют</h3>';
?>
<main>
    <div class="intro" id="catalogue">
        <div class="container">
			<div class="title_section" id="admin">Категории</div>
			<form action="controllers/category_add.php" method="POST" class="form">
				<div class="form">
					<input class="pole_reg" type="text" placeholder="Название категории" name="category" required>
					<button class="regist">Добавить</button>
				</div>
			</form>
			<form action="controllers/category_delete.php" method="POST">
				<div class="form">
					<select class="pole_reg" name="category" required>
						<option value selected disabled>Категории</option>
						<?= $categories ?>
					</select>
					<button class="regist">Удалить</button>
				</div>
			</form>

			<div class="title_section" id="admin">Добавить товар</div>
			<form enctype="multipart/form-data" action="controllers/add_product.php" method="POST" class="form">
				<input class="pole_reg" type="text" placeholder="Название" name="name" required>
				<input class="pole_reg" type="text" placeholder="Цена" name="price" required>
				<input class="pole_reg" type="text" placeholder="Страна производитель" name="country" required>
				<input class="pole_reg" type="number" placeholder="Год выпуска" name="year" required>
				<input class="pole_reg" type="text" placeholder="Модель" name="model" required>
				<select class="pole_reg" name="category" onchange="filter.filter('category', 'filter')">
                <option value disabled selected>Фильтрация по категориям</option>
                <?= $categories ?>
                </select>
				<input class="pole_reg" type="number" placeholder="Количество на складе" name="count" required>
				<div style="margin:auto;">
				<p class="corz_text" id="ph">Фотография товара</p>
				<input class="add_photo" type="file" name="image1" required>
				<p class="corz_text" id="ph">Фотография товара</p>
				<input class="add_photo" type="file" name="image2" required>
                </div>
				<button class="regist">Добавить</button>
			</form>

			<div class="title_section" id="admin">Заказы</div>
			<div class="row">
				<p>
				<span onclick="filter.filter('all', 'admin')">Все</span> |
				<span onclick="filter.filter('Новый', 'admin')">Новые</span> |
				<span onclick="filter.filter('Подтверждённый', 'admin')">Подтверждённые</span> |
				<span onclick="filter.filter('Отменённый', 'admin')">Отменённые</span>
                </p> 
            </div>
			<div class="row" id="orders">
				<?= $orders ?>
			</div>
		  </div>
		</div>
    </main>
    <script>filter.orders()</script>
    <footer class="footer" id="re_footer">
        <div class="container_foot">
             <p class="footer_text">© 2022 АО "MersBen"</p>
             <p class="footer_text" id="conf">Политика конфиденциальности</p>
        </div>
    </footer>
</body>
</html>