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
                    Управление пользователями.
                </div>
                <div class="register-form" style="margin-bottom: 0px; border-bottom: 0px; padding: 5px 15px; color: #333333; font-weight: bold;">
                    <div style="float: left; margin-right: 30px; "><a href="/admin/users/add" style="font-weight: bold; color: #333333;">Добавить пользователя</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/users/edit" style="font-weight: normal; color: #333333;">Редактировать пользователя</a></div>
                    <div style="float: left; margin-right: 30px; "><a href="/admin/products/add" style="font-weight: normal; color: #333333;">Добавить продукт</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/products/edit" style="font-weight: normal; color: #333333;">Редактировать продукты</a></div>
                    <div style="float: left; margin-right: 30px;"><a href="/admin/orders" style="font-weight: normal; color: #333333;">Заказы</a></div>
                </div>                
                <div class="register-form" style="margin-top: 0px; margin-bottom: 0px;">
                    <?php if ($result): 
                            echo '<p style="background-color: green; color: black;">Пользователь добавлен!</p>';
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
                    <form action='/admin/users/add' method='post'>
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 217px;">Имя:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="userName" value='<?php echo $name; ?>'></div>
                       </div> 
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 184px;">Фамилия:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="userSurname" value='<?php echo $surname; ?>'></div>
                       </div>      
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 203px;">E-mail:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="userEmail" value='<?php echo $email; ?>'></div>
                       </div>      
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 184px;">Телефон:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="userPhone" value='<?php echo $phone; ?>'></div>
                       </div>       
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 200px;">Адрес:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="userAddress" value='<?php echo $address; ?>'></div>
                       </div>   
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 193px;">Пароль:</div>
                           <div class="reg-label" style="float: left; margin-right: 150px;"><input style="width: 150px;" type="text" name="userPassword" value='<?php echo $password; ?>'></div>
                        </div>
                        <div style=" width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 200px;">Роль:</div>
                               <select style="width: 200px;" id="prodNames" name="userRole" class="prodNames">   
                                    <option selected="selected" value="0">Покупатель</option>
                                    <option value="Управляющий магазином">Управляющий магазином</option>
                                    <option value="Администратор">Администратор</option>
                                    <?php for ($i = 0; $i < count($categories); $i++){ ?>
                                        <option <?php if ($categories[$i]['name_latin'] == $category) echo 'selected="selected"'; ?> value="<?php echo $categories[$i]['name_latin']; ?>"><?php echo $categories[$i]['name_latin']; ?></option>
                                    <?php } ?>
                                </select> 
                        </div>
                        <div style=" margin-top: 20px; width: 100%; height: 30px; padding-top: 10px;">
                           <div class="reg-label" style="float:left; font-weight: bold; margin-right: 226px;"><input style="width: 150px;" type="submit" name="submitAddUser" value='СОХРАНИТЬ' class="add_to_cart_btn"></div>
                       </div>                         
                    </form>
                </div>
              
            </div>
        </div>
    </body>
</html>