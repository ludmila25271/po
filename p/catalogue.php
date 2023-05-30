<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MersBen</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <script src="scripts/filter.js"></script>
    <?php session_start(); ?>
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
                <a class="nav_link" href="index.php">О нас</a>
                <a class="active_link">Каталог</a>
                <a class="nav_link" href="contacts.php">Где нас найти?</a>
                <a class="nav_link" href="log_in.php">Вход</a>
             <?php
             
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
           $role = (isset($_SESSION["role"])) ? $_SESSION["role"] : "guest";
           $result = $connect->query("SELECT * FROM `categories`");
           $categories = "";
           while($row = $result->fetch_assoc())
           {
		   $categories .= sprintf('<option value="%s">%s</option>', $row["category"], $row["category"]);//Получаем список категорий
           }
           $sql = "SELECT * FROM `products` ORDER BY `created_at` DESC";//Получаем список товаров, отсортированных по дате создания записи
	if(!$result = $connect->query($sql))//Если запрос не выполнен
		return die ("Ошибка получения данных: ". $connect->error);//Выводим код об ошибке

	$data = "";//Присваиваем переменной "data" пустое значение
	//Последовательно выводим блоки с товарами
	while($row = $result->fetch_assoc())
		$data .= sprintf('
        <div class="shop_box" id="products"> <!--Товар-->
        <h3 class="prod_name">%s</h3>
        <img src="%s" height="190px" width="300px" alt="Mercedes-Benz" title="Mercedes-Benz">
        <div class="info">
         <p class="price">%s</p>
         <a class="more" href="product.php?c=products&id=%s">Подробнее</a>
         <input type="hidden" value="%s" name="id">
         <input type="hidden" value="%s" name="year">
         <input type="hidden" value="%s" name="category">
         %s
        </div>
        %s
        </div>
		', $row["name"], $row["promo"], $row["price"], $row["product_id"], $row["product_id"], $row["year"], $row["category"],
      ($role != "guest") ? '<a class="add_c" href="controllers/add_cart.php?id='. $row["product_id"] .'"><img src="img/add_cart.png" height="25px" alt="Добавить в корзину" title="Добавить в корзину"></a>' : '',
      ($role == "admin") ? '
			<div class="r">
				<p><a class="grey" id="grey1" href="update.php?id='.$row["product_id"].'">Редактировать</a></p>
				<p><a class="grey" onclick="return confirm(\'Вы действительно хотите удалить этот товар?\')" href="controllers/delete_product.php?id='.$row["product_id"].'" class="text-small">Удалить</a></p>
			</div>
		' :'');
		//Если нет прав админа, но пользователь авторизован, показываем кнопку добавления товара в корзину
		

	if($data == "")//Если переменная "data" так и не была заполнена
		$data = '<h3 class="text-center">Товары отсутствуют</h3>';//Выводим текст "Товары отсутствуют"
?>
<main>
    <div class="intro" id="catalogue">
        <div class="container">
          <h1 class="title_section"> Каталог </h1>
          <div class="row">
          <!--Добавим варианты сортировки товаров-->
          <p>
          <span id="year" onclick="filter.filter('all')">Все</span> |
          <span id="year" onclick="filter.filter('year', 'sort')">Год</span> |
          <span id="name" onclick="filter.filter('name','sort')">Наименование</span> |
          <span id="price" onclick="filter.filter('price', 'sort')">Цена</span>
          </p>
          <!--Добавим блоки для сортировки товаров по категориям-->
          <select id="category" onchange="filter.filter('category', 'filter')">
          <option value disabled selected>Фильтрация по категориям</option>
          <?= $categories ?>
          </select>
          </div>
          <div class="products" id="products_list">
          <?= $data ?>
          </div>  
         </div>
    </div>
    </main>
    <script>filter.products()</script>
    <footer class="footer" id="re_footer">
        <div class="container_foot">
             <p class="footer_text">© 2022 АО "MersBen"</p>
             <p class="footer_text" id="conf">Политика конфиденциальности</p>
        </div>
    </footer>
</body>
</html>