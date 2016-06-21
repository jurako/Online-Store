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
                        <a href="/OnlineShop/"><span style="font-weight: bold;">Вернуться в магазин</span></a>
                    </div>
                    <div class="logout-div fr">
                        <?php echo $user['Name']; ?>
                        (
                        <a href="/OnlineShop/user/logout" class="links">Выход</a>
                        )
                    </div>
                </div>

                <div class="right-title" style="margin:25px 15px; font-weight: bold;">
                    Управление заказами.
                </div>
                <div class="register-form" style="margin-bottom: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    <?php if ($user['Role'] == 1) {?>
                        <div style="float: left; margin-right: 30px; "><a href="/OnlineShop/admin/users/add" style="font-weight: normal; color: #333333;">Добавить пользователя</a></div>
                        <div style="float: left; margin-right: 30px;"><a href="/OnlineShop/admin/users/edit" style="font-weight: normal; color: #333333;">Редактировать пользователя</a></div>
                    <?php } ?>
                    <div style="float: left; margin-right: 30px; "><a href="/OnlineShop/admin/products/add" style="font-weight: normal; color: #333333;">Добавить продукт</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/OnlineShop/admin/products/edit" style="font-weight: normal; color: #333333;">Редактировать продукты</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/OnlineShop/admin/orders" style="font-weight: bold; color: #333333;">Заказы</a></div>
                </div>                    
                <div class="register-form" style="margin-bottom: 0px; margin-top: 0px; padding: 5px 15px; color: #333333; font-weight: bold; border-bottom: 0px;">
                    <div style=" width: 100%; height: 30px; padding-top: 10px; margin-bottom: 20px;">
                       <div class="reg-label" style="float:left; font-weight: bold; font-size: 100%; color: #1D96E2; margin-right: 266px;"> <?php echo $viewedUser['Name'] . ' ' . $viewedUser['Surname']; ?> </div>
                   </div>
                    <div style=" width: 100%;">
                        <form action="/OnlineShop/admin/orders/<?php echo $viewedUser['User_ID']; ?>" method="post">
                            <table style="color: #797878; font: 12px Arial; border-collapse: separate; border-spacing:10px;">
                                <thead>
                                    <tr>
                                        <td style="width: 180px; font-weight: bold;">
                                            Номер заказа
                                        </td>
                                        <td style="width: 260px; font-weight: bold;">
                                            Дата оформления
                                        </td>
                                        <td style="width: 185px; font-weight: bold;">
                                            Оплата
                                        </td>
                                        <td style="width: 180px; font-weight: bold;">
                                            Сумма заказов
                                        </td>
                                        <td style="width: 175px; font-weight: bold;">
                                            Оплачено
                                        </td>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order) { ?>
                                            <tr>    
                                                <td style="width: 180px;">
                                                    <a class="table-row" style="text-decoration: underline;" href="/OnlineShop/cabinet/orders/<?php echo $order['order_id']; ?>"> <?php echo $order['order_id']; ?></a>
                                                </td>
                                                <td style="width: 260px;">
                                                    <a class="table-row" style="text-decoration: underline;" href="/OnlineShop/cabinet/orders/<?php echo $order['order_id']; ?>"> <?php echo $order['order_date']; ?></a>
                                                </td>
                                                <td style="width: 185px;">
                                                    <a class="table-row" style="text-decoration: underline;" href="/OnlineShop/cabinet/orders/<?php echo $order['order_id']; ?>"> <span <?php if ($order['status'] == 0) echo 'style="background: #F3C7C7; color: #C7271F; padding: 3px;">не оплачен'; else echo 'style="background: #8FFF87; color: #37763A; padding: 3px;">оплачен';?></span></a>
                                                </td>
                                                <td style="width: 180px;">
                                                    <a class="table-row" style="text-decoration: underline;" href="/OnlineShop/cabinet/orders/<?php echo $order['order_id']; ?>"> <?php echo $order['total_price'] . ' €'; ?></a>
                                                </td>
                                                <?php if ($order['status'] == 0) { ?>
                                                    <td style="width: 260px;">
                                                        <input type="checkbox" name="status[]" value="<?php echo $order['order_id']?>">
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php }?>                                      
                                    </tbody>
                                </thead>
                            </table> 
                            <div class="reg-label" style="float:left; font-weight: bold; margin-right: 226px; margin-top: 20px;"><input style="width: 150px;" type="submit" name="submitEditOrderStatus" value='ИЗМЕНИТЬ' class="add_to_cart_btn"></div>                    
                        </form>   
                    </div>
                </div> 
           
                <div class="links fl">
                    <a style="display: block; margin: 10px 15px;" href="/OnlineShop/">Вернуться в магазин</a>                   
                </div>                
            </div>
        </div>
    </body>
</html>