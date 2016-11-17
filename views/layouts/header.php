<?php include_once ROOT . '/models/User.php'; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Главная</title>
	<script src="/templates/js/slider.js"></script>
        <link rel="stylesheet" type="text/css" href="/templates/css/main-style.css">
        <link rel="stylesheet" type="text/css" href="/templates/css/filters.css">
        <link rel="stylesheet" type="text/css" href="/templates/css/slider.css">
    </head>
    <body>
        <div id="wrapper">
            <!--header-->
            <div id="header">
                <div class="center-align">
                    <div id="menu">
                        <ul>
                            <li>
                                <a href="/" title="Главная">Главная</a>
                            </li>
                            <li>
                                <a href="/catalog" title="Каталог">Каталог</a>
                            </li>
                            <li>
                                <a href="/cabinet/orders" title="Личный кабинет">Личный кабинет</a>
                            </li>
                            <li>
                                <a href="/cart" title="Корзина">Корзина</a>
                            </li>
                            <li>
                                <a href="/contact" title="Обратная связь">Обратная связь</a>
                            </li>
                        </ul>
                    </div>
                    <div id="shopLogo">
                        <a href="" class="shop-logo" title="Computer Hardware Shop">
                            <img src="/templates/images/logo_main.png" alt="Computer Hardware Shop">
                        </a>
                    </div>
                    <div id="contacts">
                        <img class="phone-number" src="/templates/images/phone_icon.png" alt="phone-icon">
                        <p class="phone-number-text">    
                            67 456 789
                        </p>
                        <img class="email-icon" src="/templates/images/email_icon.png" alt="mail-icon">
                        <p class="email-text">    
                            info@computerstore.lv
                        </p>
                    </div>
                    <div id="search">
                        <form action="/search" method="post">
                            <input name="searchTextBox" class="search-text" value="<?php if (!empty($searchString)) echo $searchString; else echo 'Поиск'; ?>" onfocus="if(this.value=='Поиск'){this.value='';}" onblur="if(this.value==''){this.value='Поиск';}" type="text">
                            <input name="searchBtn" class="search-btn" value="" type="submit">
                        </form>
                    </div>
                    <div id="cart">
                        <a class="cart-inner" href="/cart">
                            <i style="margin-left:15px; font-family: Arial;">
                                <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])):
                                        echo "Корзина пуста";
                                      else :
                                        echo $_SESSION['cartSum'] . ' € | ' . $_SESSION['cartCount'];
                                    endif;
                                ?>
                            </i>
                        </a>
                    </div>
                    <div id="login">
                        <?php if (User::isGuest()): ?>
                            <img style="float:left; margin-right: 7px; margin-top: 4px;" src="/templates/images/login_icon.png" alt="login">
                            <a href="/user/login" style="color: #797878; font-size: 110%;">Вход</a>
                        <?php else: ?>
                            <img style="float:left; margin-right: 7px; margin-top: 4px;" src="/templates/images/logout_icon.png">
                            <a href="/user/logout" style="color: #797878; font-size: 110%;">Выход</a>
                        <?php endif; ?>
                    </div>                   
                </div>
            </div>
            <!--!header-->