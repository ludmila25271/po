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
	$sql = "SELECT * FROM `products` WHERE `product_id`=".$_GET["id"];
	$product = $connect->query($sql)->fetch_assoc();
	$result = $connect->query("SELECT * FROM `categories`");
	$categories = "";
	while($row = $result->fetch_assoc()) {
		$selected = ($product["category"] == $row["category"]) ? "selected" : "";
		$categories .= sprintf('<option value="%s" %s>%s</option>', $row["category"], $selected, $row["category"]);
	}
?>

<main>
	<div class="intro" id="catalogue">
		<div class="container">
			<div class="title_section" id="admin">Изменить товар</div>
			<form enctype="multipart/form-data" class="form" action="controllers/update_product.php" method="POST">
				<input class="pole_reg" type="hidden" name="id" value="<?= $product["product_id"] ?>">
				<input class="pole_reg" type="hidden" name="path" value="<?= $product["path"] ?>">
				<input class="pole_reg" type="text" placeholder="Название" name="name" value="<?= $product["name"] ?>" required>
				<input class="pole_reg" type="text" placeholder="Цена" name="price" value="<?= $product["price"] ?>" required>
				<input class="pole_reg" type="text" placeholder="Страна производитель" name="country" value="<?= $product["country"] ?>" required>
				<input class="pole_reg" type="number" placeholder="Год выпуска" name="year" value="<?= $product["year"] ?>" required>
				<input class="pole_reg" type="text" placeholder="Модель" name="model" value="<?= $product["model"] ?>" required>
				<select class="pole_reg" name="category" required>
					<option value selected disabled>Категория</option>
					<?= $categories ?>
				</select>
				<input class="pole_reg" type="number" placeholder="Количество на складе" name="count" value="<?= $product["count"] ?>" required>
				<div style="margin:auto;">
				<p class="corz_text" id="ph">Фотография товара</p>
				<input class="add_photo" type="file" name="image1" required>
				<p class="corz_text" id="ph">Фотография товара</p>
				<input class="add_photo" type="file" name="image2" required>
                </div>
				<button class="regist">Изменить</button>
			</form>
        </div>
	</div>
</main>
<footer class="footer" id="re_footer">
    <div class="container_foot">
        <p class="footer_text">© 2022 АО "MersBen"</p>
        <p class="footer_text" id="conf">Политика конфиденциальности</p>
    </div>
</footer>