<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автосалон MersBen | Купить новый автомобиль в Рязани</title>
    <meta name="description" content="Автосалон в Рязани. Приобрести новый автомобиль по выгодным ценам. Продажа авто в Рязани, качественный сервис." />
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <!--Меню-->
    <header class="header">
        <div class="container">
            <div class="head_inner">
              <h1 class="header_logo">MersBen</h1>
             <nav class="nav">
                <a class="active_link">О нас</a>
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
    <!--Главный экран-->
    <div class="intro" id="about_us">
        <div class="container">
            <h1 class="title_section">Новинки компании</h1>
          </div>
        <div class="slider">
            <div class="item">
                <a href='/product.php?c=products&id=<?=2?>'><img src="img/mers_e_class1.jpeg" alt="Первый слайд" title="Mercedes-Benz E-класс седан"></a>
                <p class="item_name">Mercedes-Benz E-класс седан</p>
            </div>
            <div class="item">
                <a href='/product.php?c=products&id=<?=3?>'><img src="img/mers_e_class_cab1.jpeg" alt="Второй слайд" title="Mercedes-Benz E-класс кабриолет"></a>
                <p class="item_name">Mercedes-Benz E-класс кабриолет</p>
            </div>
            <div class="item">
                <a href='/product.php?c=products&id=<?=9?>'><img src="img/mers_cla1.jpeg" alt="Третий слайд" title="Mercedes-Benz CLA купе"></a>
                <p class="item_name">Mercedes-Benz CLA купе</p>
            </div>
            <div class="item">
                <a href='/product.php?c=products&id=<?=7?>'><img src="img/mers_gle1.jpeg" alt="Четвёртый слайд" title="Mercedes-Benz GLE купе"></a>
                <p class="item_name">Mercedes-Benz GLE купе</p>
            </div>
            <div class="item">
                <a href='/product.php?c=products&id=<?=5?>'><img src="img/mers_e_class_k1.jpeg" alt="Пятый слайд" title="Mercedes-Benz E-класс купе"></a>
                <p class="item_name">Mercedes-Benz E-класс купе</p>
            </div>
            <div class="item">
                <a href='/product.php?c=products&id=<?=8?>'><img src="img/mers_g_class1.jpeg" alt="Шестой слайд" title="Mercedes-Benz G-класс внедорожник"></a>
                <p class="item_name">Mercedes-Benz G-класс внедорожник</p>
            </div>
            <a class="prev" onclick="minusSlide()">&#10094;</a>
            <a class="next" onclick="plusSlide()">&#10095;</a>
        </div>
        <div class="slider-dots">
            <span class="slider-dots_item" onclick="currentSlide(1)"></span>
            <span class="slider-dots_item" onclick="currentSlide(2)"></span>
            <span class="slider-dots_item" onclick="currentSlide(3)"></span>
            <span class="slider-dots_item" onclick="currentSlide(4)"></span>
            <span class="slider-dots_item" onclick="currentSlide(5)"></span>
            <span class="slider-dots_item" onclick="currentSlide(6)"></span>
        </div>
        <script src="scripts/slider.js"></script>
           <div class="container">
             <h1 class="title_section" id="title_intro" >Aвтосалон, который вам подходит</h1>
             <p class="intro_sub">MersBen - молодая компания, занимающаяся продажей новых автомобилей в Рязани. Несмотря на небольшое время существования, MersBen успела завоевать репутацию надежной компании с направлением деятельности на эффективную и долгосрочную работу.</p>
             <p class="intro_sub"> Клиентам доступны все необходимые инструменты для комфортного приобретения авто: Trade-in, кредитование, страхование, лизинг.</p>
             <p class="intro_sub"> Мы осуществляем гарантийный и пост-гарантийный ремонт автомобилей. Так же, наш технический центр готов оказать профессиональный ремонт авто любого бренда и предложить услуги по техническому обслуживанию, кузовному ремонту и широкий выбор запасных частей.</p>
           </div>
    </div>
    <footer class="footer">
        <div class="container_foot">
             <p class="footer_text">© 2022 АО "MersBen"</p>
             <p class="footer_text" id="conf">Политика конфиденциальности</p>
        </div>
    </footer>
</body>
</html> 