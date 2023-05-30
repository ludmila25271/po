<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MersBen</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
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
                <a class="active_link">Где нас найти?</a>
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
    <!--Где нас найти?-->
    <div class="intro" id="contacts">
        <div class="container">
           <h1 class="title_section">Где нас найти?</h1>
           <div class="location_contacts">
            <img src="img/map.png" width="700px">
            <div class="contacts">
                <p class="con_text">Адрес</p>
                <p class="cont">ул. Большая, д. 34, строение 1 </p>
                <p class="con_text">Номер телефона</p>
                <p class="cont">8-800-555-35-35</p>
                <p class="con_text">E-mail</p>
                <p class="cont">mers_bens@gmail.com</p>
            </div>
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