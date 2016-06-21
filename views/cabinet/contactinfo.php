<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Личный кабинет</title>
        <link rel="stylesheet" type="text/css" href="http://localhost/OnlineShop/templates/css/main-style.css">
        <link rel="stylesheet" type="text/css" href="http://localhost/OnlineShop/templates/css/filters.css">
        <link rel="stylesheet" type="text/css" href="http://localhost/OnlineShop/templates/css/cabinet.css">
        <style>
            body {
                background-image: url(http://localhost/OnlineShop/templates/images/body_bg_image.png);
                background-position: center left;
                background-repeat: repeat;
                background-attachment: scroll;
                background-color: #FAFAFA;
            }
            #wrapper {
                width: 100%;
                height: 600px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="middle" style="background-color: white; margin-top: 180px; padding-top: 5px; padding-bottom: 5px;">
                <div class="options-form">
                    <div class="links fl">
                        <a href="/OnlineShop/"><span style="font-weight: bold;">Вернуться в магазин</span></a><span style="margin: 0 7px;">|</span>
                        <a href="<?php echo $_SERVER["REQUEST_URI"]; ?>"><span style="font-weight: bold;">Контактные данные</span></a><span style="margin: 0 7px;">|</span>
                        <a href="/OnlineShop/cabinet/orders">Заказы</a><span style="margin: 0 7px;">|</span>
                        <a href="/OnlineShop/cabinet/discounts">Скидки</a><span style="margin: 0 7px;">|</span>
                        <a href="/OnlineShop/cabinet/contactshop">Обратная связь</a>
                    </div>
                    <div class="logout-div fr">
                        <?php echo $user['Name']; ?>
                        (
                        <a href="/OnlineShop/user/logout" class="links">Выход</a>
                        )
                    </div>
                </div>

                <div class="right-title" style="margin:25px 15px; font-weight: bold;">
                    Кабинет покупателя. Контакты.
                </div>
                <div class="register-form">
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <div style="background-color: #f3c7c7; color: #c7271f;padding: 5px 5px; margin-bottom: 15px;">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="">
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="float:left; font-weight: bold;"">Имя:</div>
                            <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="name" type="text" value="<?php echo $name; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="float:left; font-weight: bold;"">Фамилия:</span></div>
                            <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="surname" type="text" value="<?php echo $surname; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="float:left; font-weight: bold;"">E-mail:</div>
                            <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="email" type="email" value="<?php echo $email; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="float:left; font-weight: bold;"">Адрес:</div>
                            <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="address" type="text" value="<?php echo $address; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="float:left; font-weight: bold;"">Телефон:</div>
                            <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="phone" type="text" value="<?php echo $phone; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="float:left; font-weight: bold;"">Новый пароль:</div>
                            <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="password" type="text" value="<?php echo $password; ?>"></div>
                        </div>
                        <?php if($result == true):?>
                            <p class="right-title">Данные изменены!</p>
                        <?php endif;?>
                        <div style=" width: 100%; height: 30px; margin-top: 20px;">
                                <div style="margin-left: 155px;"><input id="button" type="submit" name="editPersonalData" value="СОХРАНИТЬ ИЗМЕНЕНИЯ" class="add_to_cart_btn"></div>
                        </div>                       
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>