<?php include ROOT.'/views/layouts/header.php';?>
<!--middle-->
<div id="middle">
    <div id="content">
        <div id="left-part">
            <div id="products_container">
                <?php if (empty($searchResult)) { ?>
                    <h2 class="right-title" style="margin:20px 20px;">По запросу "<?php echo Product::$searchString; ?>" ничего не найдено.</h2>
             <?php   } else if ($searchResult[0] == -1){ ?>
                    <h2 class="right-title" style="margin:20px 20px;">Введите ключевые слова для поиска.</h2>
             <?php  } else {
                    foreach ($searchResult as $searchItem):?>
                        <div class="single_product">
                            <div class="product_image">
                                <a class="img" href="catalog/<?php echo $searchItem['categoryName'].'/'.$searchItem['id']?>" style="background: url(templates/images/products/productID_<?php echo $searchItem['id']?>.jpg) center center no-repeat #fff;">
                                </a>
                                <p style="margin: 10px 30px;font-size: 80%;">Доступность на складе:<?php if ($searchItem['amount'] > 0) { 
                                                                                                            echo '<span style="color: green;" id="amount'; echo $searchItem['id']; echo '"> '; 
                                                                                                            echo $searchItem['amount']; 
                                                                                                            echo ' шт.</span>'; 
                                                                                                        }
                                                                                                        else {
                                                                                                            echo '<span style="color: red;" id="amount'; echo $searchItem['id']; echo '"> не доступен</span>';
                                                                                                            }?></p> 
                            </div>
                            <div class="product_info">
                                <div class="prod-name">
                                    <h2 style="margin-left: 5px;">
                                        <a href="catalog/<?php echo $searchItem['categoryName'].'/'.$searchItem['id']?>" style="font-size: 55%;"><p style="line-height: 120%;"><?php echo $searchItem['name'];?></p></a>
                                    </h2>
                                </div>
                                <div class="prod_descr">
                                    <?php echo $searchItem['desc'];?>
                                </div>
                                <div class="prod_price">
                                    <?php echo $searchItem['price']; ?> €
                                </div>
                                <div class="addToCart_mainPage">
                                    <form action="#" method="post">
                                        <input id="quantity<?php echo $searchItem['id']?>" type="text" class="quantity" name="quantity" size="3" value="1">
                                        <input id="button<?php echo $searchItem['id']?>" type="submit" value="КУПИТЬ" class="add_to_cart_btn" onclick="prodAval(this.id)">
                                    </form>
                                </div>        
                            </div>
                        </div>
                <?php endforeach; 
             }?>
            </div>
        </div>
        <div id="right-part">
            <div id="popular-prod-content">
                <h2 class="right-title">Популярные товары</h2>
                <ul class="pop-prod-list">
                    <li>
                        <a class="title" href="#">Apple MacBook Air 11 Mid 2012</a>
                        <a class="img" href="#">
                            <img src="https://static12.insales.ru/images/products/1/6652/9468412/micro_offer.image.big.jpg" alt="Apple MacBook Air 11 Mid 2012">
                        </a>
                        <p class="price">1000.43 Eur</p>
                    </li>
                    <li>
                        <a class="title" href="#">Apple MacBook Air 11 Mid 2012</a>
                        <a class="img" href="#">
                            <img src="https://static12.insales.ru/images/products/1/6652/9468412/micro_offer.image.big.jpg" alt="Apple MacBook Air 11 Mid 2012">
                        </a>
                        <p class="price">1000.43 Eur</p>
                    </li>
                    <li>
                        <a class="title" href="#">Apple MacBook Air 11 Mid 2012</a>
                        <a class="img" href="#">
                            <img src="https://static12.insales.ru/images/products/1/6652/9468412/micro_offer.image.big.jpg" alt="Apple MacBook Air 11 Mid 2012">
                        </a>
                        <p class="price">1000.43 Eur</p>
                    </li>
                    <li>
                        <a class="title" href="#">Apple MacBook Air 1012</a>
                        <a class="img" href="#">
                            <img src="https://static12.insales.ru/images/products/1/6652/9468412/micro_offer.image.big.jpg" alt="Apple MacBook Air 11 Mid 2012">
                        </a>
                        <p class="price">1000.43 Eur</p>
                    </li>
                    <li>
                        <a class="title" href="#">Apple MacBook Air 11 Mid 2012</a>
                        <a class="img" href="#">
                            <img src="https://static12.insales.ru/images/products/1/6652/9468412/micro_offer.image.big.jpg" alt="Apple MacBook Air 11 Mid 2012">
                        </a>
                        <p class="price">1000.43 Eur</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--!middle-->
<?php include ROOT.'/views/layouts/footer.php';?>

