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
                        <a href="/OnlineShop/cabinet/contactinfo">Контактные данные</a><span style="margin: 0 7px;">|</span>
                        <a href="/OnlineShop/cabinet/orders"><span style="font-weight: bold;">Заказы</span></a><span style="margin: 0 7px;">|</span>
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
                    <?php echo 'Заказ № ' . $order['Order_ID'];?>
                </div>
                <div class="register-form" style="margin-bottom: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    Состав заказа
                </div>                
                <div class="register-form" style="margin-top: 0px; margin-bottom: 0px; border-bottom: 0px;">
                    <div style=" width: 100%;">
                        <table style="color: #797878; font: 12px Arial;">
                            <thead>
                                <tr>
                                    <td style="width: 750px; font-weight: bold;">
                                        Наименование
                                    </td>
                                    <td style="width: 67px; font-weight: bold;">
                                        Кол-во
                                    </td>
                                    <td style="width: 73px; font-weight: bold;">
                                        Стоимость
                                    </td>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php foreach ($orderedItems as $item) { ?>
                                        <tr>    
                                            <td style="width: 750px;">
                                                <?php echo $item['name']; ?>
                                            </td>
                                            <td style="width: 67px;">
                                                <?php echo $item['count']; ?>
                                            </td>
                                            <td style="width: 73px;">
                                                <?php echo $item['price'] . ' €'; ?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                        <tr>    
                                            <td style="width: 750px;">
                                                Скидка: <?php if ($order['Discount_used'] == 'No') echo 'отсутствует'; else echo '20%'; ?>
                                            </td>
                                            <td style="width: 67px;">
                                                
                                            </td>
                                            <td style="width: 73px;">
                                                <?php if ($order['Discount_used'] == 'Yes') echo '- ' . number_format($order['Total_price'] / 5, 2) . ' €'; ?>
                                            </td>
                                        </tr>
                                        <tr>    
                                            <td style="width: 750px;">
                                                Доставка: <?php if ($order['Delivery_method'] == 'po_pochte') echo 'по почте'; else echo 'курьером'; ?>
                                            </td>
                                            <td style="width: 67px;">
                                                
                                            </td>
                                            <td style="width: 73px;">
                                                <?php if ($order['Delivery_method'] == 'po_pochte') echo '+ 1.00 €'; else echo '+ 10.00 €';; ?>
                                            </td>
                                        </tr>
                                        <tr>    
                                            <td style="width: 750px;">
                                                Итого:
                                            </td>
                                            <td style="width: 67px;">
                                                
                                            </td>
                                            <td style="width: 73px; font-weight: bold;">
                                                <?php echo $order['Total_price'] . ' €'; ?>
                                            </td>
                                        </tr>                                        
                                </tbody>
                        </table>
                    </div>
                </div>
                <div class="register-form" style="margin-bottom: 0px; margin-top: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    Доставка
                </div> 
                <div class="register-form" style="margin-bottom: 0px; margin-top: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                     <div style=" width: 100%; height: 30px; padding-top: 10px;">
                        <div class="reg-label" style="float:left; font-weight: bold; margin-right: 182px;">Имя:</div>
                        <div class="reg-label" style="float: left; margin-right: 150px;"><?php echo $user['Name']; ?></div>
                    </div>
                     <div style=" width: 100%; height: 30px; padding-top: 10px;">
                        <div class="reg-label" style="float:left; font-weight: bold; margin-right: 150px;">Фамилия:</div>
                        <div class="reg-label" style="float: left; margin-right: 150px;"><?php echo $user['Surname']; ?></div>
                    </div>
                     <div style=" width: 100%; height: 30px; padding-top: 10px;">
                        <div class="reg-label" style="float:left; font-weight: bold; margin-right: 170px;">E-mail:</div>
                        <div class="reg-label" style="float: left; margin-right: 150px;"><?php echo $user['E_mail']; ?></div>
                    </div>
                     <div style=" width: 100%; height: 30px; padding-top: 10px;">
                        <div class="reg-label" style="float:left; font-weight: bold; margin-right: 152px;">Телефон:</div>
                        <div class="reg-label" style="float: left; margin-right: 150px;"><?php echo $user['Phone']; ?></div>
                    </div>
                     <div style=" width: 100%; height: 30px; padding-top: 10px;">
                        <div class="reg-label" style="float:left; font-weight: bold; margin-right: 169px;">Адрес:</div>
                        <div class="reg-label" style="float: left; margin-right: 150px;"><?php echo $user['Address']; ?></div>
                    </div>
                </div>   
                <div class="register-form" style="margin-bottom: 0px; margin-top: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    Оплата
                </div>
                <div class="register-form" style="margin-bottom: 0px; margin-top: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                     <div style=" width: 100%; height: 30px; padding-top: 10px;">
                        <div class="reg-label" style="float:left; font-weight: bold; margin-right: 122px;">Статус оплаты:</div>
                        <div class="reg-label" style="float: left; margin-right: 150px;"><span <?php if ($order['Status'] == 0) echo 'style="background: #F3C7C7; color: #C7271F; padding: 3px;">не оплачен'; else echo 'style="background: #8FFF87; color: #37763A; padding: 3px;">оплачен';?></span></div>
                    </div>
                </div> 
                <div class="links fl">
                    <a style="display: block; margin: 10px 15px;" href="/OnlineShop/">Вернуться в магазин</a>                   
                </div>                
            </div>
        </div>
    </body>
</html>