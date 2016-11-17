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
                    Управление продуктами.    
                </div>
                <div class="register-form" style="margin-bottom: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    <?php if ($user['Role'] == 1) {?>
                        <div style="float: left; margin-right: 30px; "><a href="/admin/users/add" style="font-weight: normal; color: #333333;">Добавить пользователя</a></div>
                        <div style="float: left; margin-right: 30px;"><a href="/admin/users/edit" style="font-weight: normal; color: #333333;">Редактировать пользователя</a></div>
                    <?php } ?>
                    <div style="float: left; margin-right: 30px; "><a href="/admin/products/add" style="font-weight: normal; color: #333333;">Добавить продукт</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/products/edit" style="font-weight: bold; color: #333333;">Редактировать продукты</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/orders" style="font-weight: normal; color: #333333;">Заказы</a></div>
                </div>                
                <div class="register-form" style="margin-top: 0px; margin-bottom: 0px;">
                    <?php if ($result): 
                            echo '<p style="background-color: green; color: black;">Товар редактирован!</p>';
                          endif; ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                            <div style="background-color: #f3c7c7; color: #c7271f;padding: 5px 5px; margin-bottom: 15px;">
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li> - <?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                    <?php endif; ?>
                    <div style=" width: 100%; height: 30px; padding-top: 10px; margin-bottom: 20px;">
                       <div class="reg-label" style="float:left; font-weight: bold; font-size: 100%; color: #1D96E2; margin-right: 266px;"> <?php echo $product['name']; ?> </div>
                   </div>                      
                    <form action='/admin/products/edit/<?php echo $product['id']; ?>' method='post'>
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 185px;">Название продукта:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="productName" value='<?php echo $name; ?>'></div>
                       </div> 
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 266px;">Цена:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="productPrice" value='<?php echo $price; ?>'></div>
                       </div>      
                        <div style=" width: 100%; height: 70px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 203px;">Характеристики:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><textarea style="width: 350px;" name="productCharact" value='<?php echo $charact; ?>'><?php echo $charact; ?></textarea></div>
                       </div>      
                        <div style=" width: 100%; height: 70px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 182px;">Описание продукта:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><textarea style="width: 350px;" name="productDesc" value='<?php echo $desc; ?>'><?php echo $desc; ?></textarea></div>
                       </div>       
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 226px;">Количество:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="productAmount" value='<?php echo $amount; ?>'></div>
                       </div>   
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 230px;">Категория:</div>
                           <div class="reg-label" style="float: left; margin-left: 7px;"><input style="width: 150px;" type="text" name="productCategory" value='<?php echo $category; ?>'></div>
                       </div>
                        <div style=" margin-top: 20px; width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 226px;"><input style="width: 150px;" type="submit" name="submitEditProduct" value='РЕДАКТИРОВАТЬ' class="add_to_cart_btn"></div>
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 196px;"><input style="width: 150px;" type="submit" name="submitDeleteProduct" value='УДАЛИТЬ' class="add_to_cart_btn"></div>
                       </div>                         
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>