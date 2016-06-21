<?php include ROOT.'/views/layouts/header.php';?>
<!--middle-->
<div id="middle">
    <div id="content">
        <div id="left-part">
            <div id="products_container">
                <h2 class='right-title' style='margin: 20px 20px;'>Обратная связь</h2>
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
                    <form action="/OnlineShop/contact" method="post">
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
        <div id="right-part">
            <div id="popular-prod-content">
                <h2 class="right-title">Популярные товары</h2>
                <ul class="pop-prod-list">
                    <?php foreach ($popularProducts as $product) { ?>
                        <li>
                            <a class="title" href="catalog/<?php echo $product['categoryName'].'/'.$product['id']?>"><?php echo $product['name']; ?></a>
                            <a class="img" href="catalog/<?php echo $product['categoryName'].'/'.$product['id']?>">
                                <img src="http://localhost/OnlineShop/templates/images/products/productID_<?php echo $product['id'] . '_small'?>.jpg" alt="<?php echo $product['name']; ?>">
                            </a>
                            <p class="price"><?php echo $product['price']; ?> €</p>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--!middle-->
<?php include ROOT.'/views/layouts/footer.php';?>
