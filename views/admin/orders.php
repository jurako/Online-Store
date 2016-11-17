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
                        <a href="/"><span style="font-weight: bold;">Вернуться в магазин</span></a>
                    </div>
                    <div class="logout-div fr">
                        <?php echo $user['Name']; ?>
                        (
                        <a href="/user/logout" class="links">Выход</a>
                        )
                    </div>
                </div>

                <div class="right-title" style="margin:25px 15px; font-weight: bold;">
                    Управление заказами.
                </div>
                <div class="register-form" style="margin-bottom: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    <?php if ($user['Role'] == 1) {?>
                        <div style="float: left; margin-right: 30px; "><a href="/admin/users/add" style="font-weight: normal; color: #333333;">Добавить пользователя</a></div>
                        <div style="float: left; margin-right: 30px;"><a href="/admin/users/edit" style="font-weight: normal; color: #333333;">Редактировать пользователя</a></div>
                    <?php } ?>
                    <div style="float: left; margin-right: 30px; "><a href="/admin/products/add" style="font-weight: normal; color: #333333;">Добавить продукт</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/products/edit" style="font-weight: normal; color: #333333;">Редактировать продукты</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/orders" style="font-weight: bold; color: #333333;">Заказы</a></div>
                </div>                    
                <?php foreach ($users as $user) { ?>
                <div class="register-form" style="margin-bottom: 0px; margin-top: 0px; padding: 5px 15px; color: #333333; font-weight: bold; border-bottom: 0px;">
                    <div class="reg-label" style="float:left; font-weight: bold; margin-right: 122px;"><a href="/admin/orders/<?php echo $user['id']; ?>"><?php echo $user['name'] . ' ' . $user['surname']; ?></a></div>
                </div> 
               <?php }?>
                <div class="links fl">
                    <a style="display: block; margin: 10px 15px;" href="/">Вернуться в магазин</a>                   
                </div>                
            </div>
        </div>
    </body>
</html>