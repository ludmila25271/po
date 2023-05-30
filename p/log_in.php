<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MersBen</title>
    <link rel="stylesheet" href="css/style.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
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
                <a class="active_link">Вход</a>
             
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
    <!--Вход-->
    <div class="intro" id="login_page">
        <div class="container">
            <h1 class="title_section">Добро пожаловать!</h1>
            <p class="sub_section">Пожалуйста, авторизуйтесь</p>
         <form class="log"  action="controllers/auth.php" id="LoginForm" method="POST">
           <div class="pl_log">
               <input name="login" type="text" class="poletext" placeholder="Логин">
               <input name="password" type="password" class="poletext" placeholder="Пароль">
           </div>
            <div class="pl_log">
              <button type="submit" name="submit1" class="btn3">Войти</button>
              <input type="button" class="btn4" value="Зарегистрироваться" onclick="parent.location='registr.php'" >
            </div>
         </form>
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