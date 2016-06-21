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
            <div id="middle" style="background-color: white; margin-top: 180px; padding-top: 5px; padding-bottom: 5px; overflow: hidden;">
                <div class="options-form">
                    <div class="links fl">
                        <a href="/OnlineShop/"><span style="font-weight: bold;">Вернуться в магазин</span></a><span style="margin: 0 7px;">|</span>
                        <a href="/OnlineShop/cabinet/contactinfo">Контактные данные</a><span style="margin: 0 7px;">|</span>
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
                    Оформление заказа.
                </div>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <div style="background-color: #f3c7c7; color: #c7271f;padding: 5px 5px; margin-bottom: 15px;">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                <div class="register-form" style="width: 600px; float: left;">
                    <form method="post" action="/OnlineShop/order/confirm">
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="margin:10px px; font-size: 100%; font-weight: bold;">Контактные данные:</div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float: left; font-weight: bold;">Имя:</span></div>
                            <div style="float: right; margin-right: 300px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="name" type="text" value="<?php echo $name; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left; font-weight: bold;">Фамилия:</span></div>
                            <div style="float: right; margin-right: 300px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="surname" type="text" value="<?php echo $surname; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left; font-weight: bold;">E-mail:</div>
                            <div style="float: right; margin-right: 300px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="email" type="email" value="<?php echo $email; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left; font-weight: bold;">Адрес:</div>
                            <div style="float: right; margin-right: 300px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="address" type="text" value="<?php echo $address; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left; font-weight: bold;">Телефон:</div>
                            <div style="float: right; margin-right: 300px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="phone" type="text" value="<?php echo $phone; ?>"></div>
                        </div>
                        <div style=" width: 100%; height: 30px;">
                            <div class="reg-label" style="margin:10px px; font-size: 100%; font-weight: bold;">Способ доставки:</div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left;"><input name="delivery" <?php if (!empty($delivery)) if ($delivery == 'po_pochte') echo 'checked=checked';?> type="radio" value="po_pochte"><span style="margin-left: 10px;">По почте</span></div>
                            <div class="reg-label" style="float:right; font-weight: bold;">+  1.00 €</div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left;"><input name="delivery" <?php if (!empty($delivery)) if ($delivery == 'kurjerom') echo 'checked=checked';?> type="radio" value="kurjer"><span style="margin-left: 10px;">Курьер</span></div>
                            <div class="reg-label" style="float:right; font-weight: bold;">+  10.00 €</div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left; font-weight: bold;">Использовать скидку:</div>
                            <div style="float: right; margin-right: 298px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="discount" type="text" value="<?php echo $discount; ?>"></div>
                        </div>                        
                        <div style=" width: 100%; height: 30px; margin: 10px 0px;">
                            <div class="reg-label" style="float:left; font-weight: bold;">Комментарий к заказу:</div>
                            <div style="float: right; margin-right: 180px;"><textarea style="border: 1px solid #dee0e1; width: 260px;" name="comment"><?php if (!empty($comment)) echo $comment; ?></textarea></div>
                        </div>
                        <div style=" width: 100%; height: 30px; margin-top: 60px;">
                                <div style="margin-left: 155px;"><input id="button" type="submit" name="confirmOrder" value="ПОДТВЕРДИТЬ ЗАКАЗ" class="add_to_cart_btn"></div>
                        </div>                       
                    </form>
                </div>
                <div class="register-form" style="width: 200px; height: 400px; float: right;">
                    <div style="width: auto; height: 20px; border-bottom: 1px solid #dee0e1; text-align: center;">
                        <a href="/OnlineShop/cart" style="color: "><span style="font-weight: bold">Ваш заказ</span> (<?php echo $_SESSION['cartCount']; ?> товара) </a>
                    </div>
                    <div style="width: auto; margin-top: 10px; border-bottom: 1px solid #dee0e1; overflow: hidden;">
                            <?php $db = Db::getConnection();
                            foreach ($_SESSION['cart'] as $id => $quantity) {
                                $product = [];
                                $result1 = $db->query('SELECT Product_ID, Name, Price FROM products WHERE Product_ID="'.$id.'"');
                                while ($row = $result1->fetch()) {
                                    $product['id'] = $row['Product_ID'];
                                    $product['name'] = $row['Name'];
                                    $product['price'] = $row['Price'];
                                }
                            ?>
                            <div style="margin-bottom: 15px; overflow: hidden; border-bottom: 1px dashed #dee0e1;" >
                                <div style="float: right;"><?php echo $product['name']; ?></div>
                                <div style="float: left;"><img  src="templates/images/products/productID_<?php echo $product['id'] . '_small'?>.jpg" alt="<?php echo $product['name']; ?>"></div>
                                <p class="price" style="float: right;"><?php echo $quantity;?> x <?php echo $product['price']; ?> €</p>
                            </div>
                            <?php } ?>
                    </div>
                    <div style="width: auto; height: 20px;">
                        <span style="font-weight: bold; float: left;">Итого:</span> <span style="font-weight: bold; float: right;"><?php echo $_SESSION['cartSum']; ?> €</span> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>