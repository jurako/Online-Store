<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Личный кабинет</title>
        <link rel="stylesheet" type="text/css" href="/templates/css/main-style.css">
        <link rel="stylesheet" type="text/css" href="/templates/css/filters.css">
        <link rel="stylesheet" type="text/css" href="/templates/css/cabinet.css">
        <style>
            body {
                background-image: url(/templates/images/body_bg_image.png);
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
                        <a href="/"><span style="font-weight: bold;">Вернуться в магазин</span></a><span style="margin: 0 7px;">|</span>
                        <a href="/cabinet/contactinfo">Контактные данные</a><span style="margin: 0 7px;">|</span>
                        <a href="<?php echo htmlentities($_SERVER["REQUEST_URI"]); ?>"><span style="font-weight: bold;">Заказы</span></a><span style="margin: 0 7px;">|</span>
                        <a href="/cabinet/discounts">Скидки</a><span style="margin: 0 7px;">|</span>
                        <a href="/cabinet/contactshop">Обратная связь</a>
                    </div>
                    <div class="logout-div fr">
                        <?php echo $user['Name']; ?>
                        (
                        <a href="/user/logout" class="links">Выход</a>
                        )
                    </div>
                </div>
                <div class="right-title" style="margin:25px 15px; font-weight: bold;">
                    Кабинет покупателя. Заказы.
                </div>
                <div class="register-form" style="margin-bottom: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    История заказов
                </div>                
                <div class="register-form" style="margin-top: 0px; margin-bottom: 0px;">
                    <div style=" width: 100%;">
                        <table style="color: #797878; font: 12px Arial; border-collapse: separate; border-spacing:10px;">
                            <thead>
                                <tr>
                                    <td style="width: 180px; font-weight: bold;">
                                        Номер заказа
                                    </td>
                                    <td style="width: 342px; font-weight: bold;">
                                        Дата оформления
                                    </td>
                                    <td style="width: 185px; font-weight: bold;">
                                        Оплата
                                    </td>
                                    <td style="width: 180px; font-weight: bold;">
                                        Сумма заказов
                                    </td>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) { ?>
                                        <tr>    
                                            <td style="width: 180px;">
                                                <a class="table-row" style="text-decoration: underline;" href="/cabinet/orders/<?php echo $order['order_id']; ?>"> <?php echo $order['order_id']; ?></a>
                                            </td>
                                            <td style="width: 342px;">
                                                <a class="table-row" style="text-decoration: underline;" href="/cabinet/orders/<?php echo $order['order_id']; ?>"> <?php echo $order['order_date']; ?></a>
                                            </td>
                                            <td style="width: 185px;">
                                                <a class="table-row" style="text-decoration: underline;" href="/cabinet/orders/<?php echo $order['order_id']; ?>"> <span <?php if ($order['status'] == 0) echo 'style="background: #F3C7C7; color: #C7271F; padding: 3px;">не оплачен'; else echo 'style="background: #8FFF87; color: #37763A; padding: 3px;">оплачен';?></span></a>
                                            </td>
                                            <td style="width: 180px;">
                                                <a class="table-row" style="text-decoration: underline;" href="/cabinet/orders/<?php echo $order['order_id']; ?>"> <?php echo $order['total_price'] . ' €'; ?></a>
                                            </td>                                            
                                        </tr>
                                    <?php }?>                                      
                                </tbody>
                            </thead>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>