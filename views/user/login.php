<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Регистрация</title>
        <link rel="stylesheet" type="text/css" href="/templates/css/main-style.css">
        <link rel="stylesheet" type="text/css" href="/templates/css/filters.css">
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
                <div class="right-title" style="margin:25px 15px;">Вход в учетную запись</div>
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
                                <div class="reg-label" style="float:left; font-weight: bold;">E-mail:</div>
                                <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="email" type="email" value="<?php echo $email; ?>"></div>
                            </div>
                            <div style=" width: 100%; height: 30px;">
                                <div class="reg-label" style="float:left; font-weight: bold;">Пароль:</div>
                                <div style="float: right; margin-right: 600px;"><input style="border: 1px solid #dee0e1;" placeholder="" name="password" type="password" value="<?php echo $password; ?>"></div>
                            </div>

                            <div style=" width: 100%; height: 30px; margin-top: 5px;">
                                <div style="margin-left: 155px;"><input id="button" type="submit" name="submit" value="ВОЙТИ" class="add_to_cart_btn"></div>
                            </div>
                            <div style="width: 100%; height: 20px; padding-top: 10px; padding-left: 160px;">
                                <a href="/user/register" class="register-if-not" >Зарегистрироваться</a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </body>
</html>