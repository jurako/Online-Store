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
                        <a href="/cabinet/contactinfo">Контактные данные</span></a><span style="margin: 0 7px;">|</span>
                        <a href="/cabinet/orders">Заказы</a><span style="margin: 0 7px;">|</span>
                        <a href="/cabinet/discounts">Скидки</a><span style="margin: 0 7px;">|</span>
                        <a href="<?php echo htmlentities($_SERVER["REQUEST_URI"]); ?>"><span style="font-weight: bold;">Обратная связь</span></a>
                    </div>
                    <div class="logout-div fr">
                        <?php echo $user['Name']; ?>
                        (
                        <a href="/user/logout" class="links">Выход</a>
                        )
                    </div>
                </div>

                <div class="right-title" style="margin:25px 15px; font-weight: bold;">
                    Кабинет покупателя. Форма обратной связи с магазином.
                </div>
                <div class="register-form">
                    <?php if ($result) echo"<h2 class='right-title' style='margin: 20px 20px;'>Отзыв отправлен!</h2>"; ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <div style="background-color: #f3c7c7; color: #c7271f;padding: 5px 5px; margin-bottom: 15px;">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li> - <?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div style="width: 100%; height: 30px; text-align: center; font-family: Arial, Helvetica, sans-serif; color: #797878; line-height: 1.8;">
                        Ваш вопрос, отзыв или пожелание:
                    </div>
                    <div style="width: 100%; height: auto; text-align: center; font-family: Arial, Helvetica, sans-serif; color: #797878; line-height: 1.8;">
                        <form action="/cabinet/contact" method="post">
                            <textarea cols="50" rows="8" name="feedback"><?php echo $feedback; ?></textarea>
                            <div style="margin-top: 15px;">Адрес для получения ответа:</div>
                            <input type="text" value="<?php if (isset($_SESSION['userId'])) echo $user['E_mail']; ?>" name="email">
                            <div style="margin-top: 10px;">
                                <input type="submit" value="Отправить сообщение" name="submitFeedback">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>