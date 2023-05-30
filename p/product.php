<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MersBen</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@100;200;300;400;500&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <!--Меню-->
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
      <!--Товар 1-->
    <div class="intro" id="product"><?php
        $connect = mysqli_connect('localhost', 'root', '', 'users'); 
        $products = $connect->query("SELECT * FROM `products` WHERE `product_id` =$_GET[id];");
        $products = mysqli_fetch_all($products);
        foreach ($products as $product) {
        ?>
          <h1 class="title_section"><?= $product[2] ?></h1>
           <div class="product_info">
            <img class="prod_img" src="<?= $product[1] ?>">
            <div class="container">
            <div class="about_prod">
                <div>
                <p class="char">Страна-производитель: <?= $product[4] ?></p>
                <p class="char">Модель: <?= $product[5] ?></p>
                <p class="char">Год выпуска: <?= $product[7] ?></p>
                </div>
                <div class="c">
                <p class="prod_price"><?= $product[3] ?></p>
                </div>
                
            </div>
            <?php
                if ($_SESSION["role"]=="admin") {
                    echo '<div class="r" id="prod_admin">
				<p><a class="grey" id="wh" href="update.php?id='.$_GET['id'].'">Редактировать</a></p>
				<p><a class="grey" id="wh" onclick="return confirm(\'Вы действительно хотите удалить этот товар?\')" href="controllers/delete_product.php?id='.$_GET['id'].'">Удалить</a></p>
			    </div>';
                }
			?>
          </div>
        </div>
        <?php
        }
        ?>
    </div>
    <footer class="footer" id="re2_footer">
        <div class="container_foot">
             <p class="footer_text">© 2022 АО "MersBen"</p>
             <p class="footer_text" id="conf">Политика конфиденциальности</p>
        </div>
    </footer>
</body>
</html>